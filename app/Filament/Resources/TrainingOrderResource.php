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
use Filament\Support\RawJs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrainingOrderResource extends Resource
{
    protected static ?string $model = TrainingOrder::class;

    protected static ?string $pluralLabel = 'Pesanan Pelatihan';
    protected static ?string $navigationLabel = 'Pesanan Pelatihan';
    protected static ?string $navigationGroup = 'Manajemen Pemasukan';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pesanan Pelatihan')
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
                            ->default(fn() => 'PEL-' . strtoupper(Str::random(12))),
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
                            ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('l, d F Y H:i')),
                    ]),
                Section::make('Detail Pelatihan')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('orderDetails')
                            ->relationship()
                            ->label('Pelatihan yang dipesan')
                            ->schema([
                                Forms\Components\Select::make('training_price_id')
                                    ->label('Pilihan Pelatihan')
                                    ->required()
                                    ->helperText('Pastikan memilih ANC dan ABDOMEN di pelatihan yang sama')
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->options(function () {
                                        return \App\Models\TrainingPrice::with(['training', 'city', 'trainingType'])
                                            ->get()
                                            ->groupBy(fn($item) => $item->training->judul)
                                            ->mapWithKeys(function ($group, $judul) {
                                                return [
                                                    $judul => $group->mapWithKeys(function ($item) {
                                                        $isExpired = optional($item->start_date)->isPast();
                                                        return [$item->id => sprintf(
                                                            '%s (%s) - %s s.d. %s - Rp %s%s',
                                                            $item->city->name,
                                                            $item->trainingType->name,
                                                            optional($item->start_date)->translatedFormat('l, d'),
                                                            optional($item->end_date)->translatedFormat('l, d F Y'),
                                                            number_format($item->price, 0, ',', '.'),
                                                            $isExpired ? ' (Sudah Terselenggara)' : ''
                                                        )];
                                                    })->toArray(),
                                                ];
                                            })->toArray();
                                    })
                                    ->disableOptionWhen(function (string $value): bool {
                                        $price = \App\Models\TrainingPrice::find($value);
                                        return optional($price?->start_date)->isPast();
                                    })
                                    ->reactive()
                                    ->preload()
                                    ->searchable()
                                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                        self::updateTotalHarga($get, $set);
                                    }),
                            ])
                            ->defaultItems(1)
                            ->maxItems(2)
                            ->columns(1)
                            ->columnSpanFull()
                            ->addActionLabel('Tambah Pelatihan')
                            ->deleteAction(
                                fn(Forms\Components\Actions\Action $action) => $action->requiresConfirmation(),
                            )
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                self::updateTotalHarga($get, $set);
                            }),
                    ]),
                Section::make('Informasi Pembayaran')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('total_harga')
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

    protected static function updateTotalHarga(Forms\Get $get, Forms\Set $set): void
    {
        $orderDetails = $get('orderDetails');

        $total = 0;

        if (is_array($orderDetails)) {
            foreach ($orderDetails as $detail) {
                if (isset($detail['training_price_id'])) {
                    $trainingPrice = \App\Models\TrainingPrice::find($detail['training_price_id']);
                    if ($trainingPrice) {
                        $total += $trainingPrice->price;
                    }
                }
            }
        }

        $set('total_harga', $total);
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
