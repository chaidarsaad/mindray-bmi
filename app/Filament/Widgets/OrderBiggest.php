<?php

namespace App\Filament\Widgets;

use App\Models\ProductOrder;
use App\Models\TrainingOrder;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OrderBiggest extends BaseWidget
{
    use InteractsWithPageFilters, HasWidgetShield;

    protected static ?string $heading = 'Sumber Pemasukan';
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions([5, 10, 25, 50, 100, 250])
            ->defaultPaginationPageOption(5)
            ->query(function (): Builder {
                $startDate = !empty($this->filters['startDate'])
                    ? \Carbon\Carbon::parse($this->filters['startDate'])->startOfDay()
                    : \Carbon\Carbon::create(2025, 1, 1);

                $endDate = !empty($this->filters['endDate'])
                    ? \Carbon\Carbon::parse($this->filters['endDate'])->endOfDay()
                    : now()->endOfDay();

                // Query untuk TrainingOrder
                $trainingOrders = TrainingOrder::select(
                    'order_number',
                    'name',
                    'total_harga',
                    'created_at',
                    DB::raw("'Pelatihan' as type"),
                    'id'
                )
                    ->where('payment_status', 'paid')
                    ->whereBetween('created_at', [$startDate, $endDate]);

                // Query untuk ProductOrder
                $productOrders = ProductOrder::select(
                    'order_number',
                    'name',
                    'total_harga',
                    'created_at',
                    DB::raw("'Alat USG' as type"),
                    'id'
                )
                    ->where('payment_status', 'paid')
                    ->whereBetween('created_at', [$startDate, $endDate]);

                return ProductOrder::fromSub(
                    $trainingOrders->unionAll($productOrders),
                    'combined_orders'
                )->orderByDesc('total_harga');
            })
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('No. Pesanan'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pemesan'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Pesanan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Alat USG' => 'success',
                        'Pelatihan' => 'primary',
                    }),
            ]);
    }
}
