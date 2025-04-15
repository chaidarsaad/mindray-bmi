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
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProductOrderResource extends Resource
{
    protected static ?string $model = ProductOrder::class;

    protected static ?string $pluralLabel = 'Pesanan Produk USG';
    protected static ?string $navigationLabel = 'Pesanan Produk USG';
    protected static ?string $navigationGroup = 'Manajemen Produk';
    protected static ?int $navigationSort = 9;

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
                        Forms\Components\TextInput::make('created_at')
                            ->readOnly()
                            ->label('Tanggal Pesan')
                            ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d F Y H:i')),
                    ]),
                Section::make('Informasi Pembayaran')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('total_harga')
                            ->prefix('Rp')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                OrderStatusService::STATUS_PENDING => OrderStatusService::getStatusLabel(OrderStatusService::STATUS_PENDING),
                                OrderStatusService::PAYMENT_VERIFYING => OrderStatusService::getStatusLabel(OrderStatusService::PAYMENT_VERIFYING),
                                OrderStatusService::STATUS_PROCESSING => OrderStatusService::getStatusLabel(OrderStatusService::STATUS_PROCESSING),
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
                            ->openable()
                            ->downloadable(),
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
                    ->dateTime('d M Y H:i')
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
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status'),
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
