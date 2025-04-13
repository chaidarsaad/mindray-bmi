<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingOrderResource\Pages;
use App\Filament\Resources\TrainingOrderResource\RelationManagers;
use App\Models\Training;
use App\Models\TrainingOrder;
use App\Models\TrainingPrice;
use App\Services\OrderStatusService;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrainingOrderResource extends Resource
{
    protected static ?string $model = TrainingOrder::class;

    protected static ?string $pluralLabel = 'Pesanan Pelatihan';
    protected static ?string $navigationLabel = 'Pesanan Pelatihan';
    protected static ?string $navigationGroup = 'Manajemen Pelatihan';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pesanan Pelatihan')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Akun Pengguna')
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
                            ->default(fn() => 'ORD-' . strtoupper(Str::random(12))),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pemesan')
                            ->required()
                            ->maxLength(255)
                            ->reactive(),
                        Forms\Components\TextInput::make('email')
                            ->email()
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
                            ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d M Y H:i')),
                    ]),
                // Section::make('Detail Pelatihan')
                //     ->collapsible()
                //     ->schema([
                //         Select::make('training_price_id')
                //             ->label('Harga')
                //             ->options(
                //                 fn(callable $get) =>
                //                 \App\Models\TrainingPrice::where('training_id', $get('training_id'))
                //                     ->whereHas('trainingType', fn($q) => $q->where('slug', 'anc'))
                //                     ->with('city')
                //                     ->get()
                //                     ->filter(fn($item) => $item->city) // pastikan relasi ada
                //                     ->mapWithKeys(fn($item) => [
                //                         $item->id => "{$item->city->name} ({$item->start_date} - {$item->end_date})"
                //                     ])
                //                     ->toArray()
                //             )

                //     ]),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pemesan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Nomor Pesanan')
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
                    ->modalHeading(fn($record) => 'Hapus Pesanan Pelatihan: ' . $record->order_number),
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

    public static function canCreate(): bool
    {
        return true;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingOrders::route('/'),
            'create' => Pages\CreateTrainingOrder::route('/create'),
            'edit' => Pages\EditTrainingOrder::route('/{record}/edit'),
        ];
    }
}
