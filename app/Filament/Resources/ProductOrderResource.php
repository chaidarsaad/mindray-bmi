<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductOrderResource\Pages;
use App\Filament\Resources\ProductOrderResource\RelationManagers;
use App\Models\ProductOrder;
use App\Services\OrderStatusService;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProductOrderResource extends Resource
{
    protected static ?string $model = ProductOrder::class;


    protected static ?string $pluralLabel = 'Pesanan Produk USG';
    protected static ?string $navigationLabel = 'Pesanan Produk USG';
    protected static ?string $navigationGroup = 'Manajemen Pemasukan';
    protected static ?int $navigationSort = 7;

    protected static ?string $label = '';
    public static function getGloballySearchableAttributes(): array
    {
        return ['order_number', 'name', 'email', 'phone', 'address'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Nomor Pesanan' => $record->order_number,
            'Nama Pemesan' => $record->name,
            'Email Pemesan' => $record->email,
            'Nomor HP Pemesan' => $record->phone,
            'Alamat Pemesan' => $record->address,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pesanan Produk USG')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Akun Pengguna')
                            ->required()
                            ->helperText('Hanya pengguna yang telah mendaftar yang bisa dipilih')
                            ->relationship('user', 'name')
                            ->preload()
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $user = \App\Models\User::find($state);
                                    if ($user) {
                                        $set('name', $user->name);
                                        $set('email', $user->email);
                                        $set('phone', $user->phone_number ?? '');
                                    }
                                } else {
                                    $set('name', '');
                                    $set('email', '');
                                    $set('phone', '');
                                }
                            }),
                        Forms\Components\TextInput::make('order_number')
                            ->label('Nomor Pesanan')
                            ->readOnly()
                            ->required()
                            ->maxLength(255)
                            ->default(fn() => 'USG-' . strtoupper(Str::random(12))),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pemesan')
                            ->readOnly()
                            ->required()
                            ->maxLength(255)
                            ->reactive(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->readOnly()
                            ->required()
                            ->maxLength(255)
                            ->reactive(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor HP')
                            ->tel()
                            ->required()
                            ->maxLength(255)
                            ->reactive(),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Pengiriman')
                            ->helperText('Kosongkan jika produk tidak perlu dikirim')
                            ->rows(3),
                        Forms\Components\TextInput::make('created_at')
                            ->readOnly()
                            ->label('Tanggal Pesan')
                            ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('l, d F Y H:i')),
                    ]),
                Section::make('Produk Dipesan')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Produk yang Dipesan')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->options(
                                \App\Models\Product::all()->mapWithKeys(fn($product) => [
                                    $product->id => $product->name . ($product->subname ? " ({$product->subname})" : ''),
                                ])
                            ),

                    ]),
                Section::make('Informasi Pembayaran')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('total_harga')
                            ->prefix('Rp')
                            ->prefix('Rp')
                            ->required()
                            ->mask(
                                RawJs::make(<<<'JS'
                                    $input => {
                                        let number = $input.replace(/[^\d]/g, '');
                                        if (number === '') return '0';
                                        return new Intl.NumberFormat('id-ID').format(Number(number));
                                    }
                                JS)
                            )
                            ->stripCharacters([',', '.'])
                            ->numeric(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                OrderStatusService::STATUS_PENDING => OrderStatusService::getStatusLabel(OrderStatusService::STATUS_PENDING),
                                OrderStatusService::PAYMENT_VERIFYING => OrderStatusService::getStatusLabel(OrderStatusService::PAYMENT_VERIFYING),
                                OrderStatusService::STATUS_PROCESSING => OrderStatusService::getStatusLabel(OrderStatusService::STATUS_PROCESSING),
                                OrderStatusService::STATUS_DELIVERING => OrderStatusService::getStatusLabel(OrderStatusService::STATUS_DELIVERING),
                                OrderStatusService::STATUS_COMPLETED => OrderStatusService::getStatusLabel(OrderStatusService::STATUS_COMPLETED),
                                OrderStatusService::STATUS_CANCELLED => OrderStatusService::getStatusLabel(OrderStatusService::STATUS_CANCELLED),
                            ])
                            ->native(false)
                            ->required()
                            ->default(OrderStatusService::STATUS_PENDING),
                        Forms\Components\Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                OrderStatusService::PAYMENT_UNPAID => OrderStatusService::getPaymentStatusLabel(OrderStatusService::PAYMENT_UNPAID),
                                OrderStatusService::PAYMENT_PAID => OrderStatusService::getPaymentStatusLabel(OrderStatusService::PAYMENT_PAID),
                            ])
                            ->required()
                            ->default(OrderStatusService::PAYMENT_UNPAID)
                            ->native(false),
                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Bukti Pembayaran')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => 'bukti-transfer-alat-usg' . $file->hashName()
                            )
                            ->image()
                            ->maxSize(500)
                            ->downloadable()
                            ->openable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions([5, 25, 50, 100, 250])
            ->defaultPaginationPageOption(5)
            ->defaultSort('id', direction: 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('l, d F Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Nomor Pesanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pemesan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        OrderStatusService::STATUS_PENDING => 'warning',
                        OrderStatusService::STATUS_PROCESSING => 'info',
                        OrderStatusService::STATUS_DELIVERING => 'info',
                        OrderStatusService::PAYMENT_VERIFYING => 'denger',
                        OrderStatusService::STATUS_COMPLETED => 'success',
                        OrderStatusService::STATUS_CANCELLED => 'danger',
                    })
                    ->formatStateUsing(fn($state) => OrderStatusService::getStatusLabel($state)),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        OrderStatusService::PAYMENT_UNPAID => 'danger',
                        OrderStatusService::PAYMENT_PAID => 'success',
                    })
                    ->formatStateUsing(fn($state) => OrderStatusService::getPaymentStatusLabel($state)),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Nomor HP')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(fn($record) => 'Hapus Pesanan Produk USG: ' . $record->order_number),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductOrders::route('/'),
            'create' => Pages\CreateProductOrder::route('/create'),
            'edit' => Pages\EditProductOrder::route('/{record}/edit'),
        ];
    }
}
