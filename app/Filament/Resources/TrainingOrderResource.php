<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingOrderResource\Pages;
use App\Filament\Resources\TrainingOrderResource\RelationManagers;
use App\Models\TrainingOrder;
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
use Illuminate\Support\Facades\Auth;

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
                            ->relationship('user', 'name')
                            ->preload()
                            ->searchable()
                            ->default(fn($get) => $get('user_id') ?? Auth::id())
                            ->hidden(),
                        Forms\Components\TextInput::make('order_number')
                            ->label('Nomor Pesanan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pesanan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor HP')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('created_at')
                            ->label('Tanggal Pesan')
                            ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d M Y H:i')),
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
                            ->required(),
                        Forms\Components\Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                OrderStatusService::PAYMENT_UNPAID => OrderStatusService::getPaymentStatusLabel(OrderStatusService::PAYMENT_UNPAID),
                                OrderStatusService::PAYMENT_PAID => OrderStatusService::getPaymentStatusLabel(OrderStatusService::PAYMENT_PAID),
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Bukti Pembayaran')
                            ->openable()
                            ->downloadable(),
                    ]),
                // Forms\Components\Textarea::make('notes')
                //     ->columnSpanFull(),
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
                Tables\Actions\DeleteAction::make(),
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
        return false;
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
