<?php

namespace App\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\ProductOrder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Range;
use Filament\Tables\Columns\Summarizers\Sum;

class BestSellingProduct extends BaseWidget
{
    use InteractsWithPageFilters, HasWidgetShield;

    protected static ?string $heading = 'Alat USG Terjual';
    protected static ?int $sort = 1;
    protected static bool $isLazy = false;
    public function getTableRecordKey($record): string
    {
        return (string) $record->product_id;
    }

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

                return ProductOrder::query()
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->where('payment_status', 'paid')
                    ->selectRaw('product_id, count(*) as total, sum(total_harga) as Total_Pemasukan')
                    ->groupBy('product_id')
                    ->with(['product'])
                    ->orderByDesc('total');
            })
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Nama Produk')
                    ->limit(20),
                Tables\Columns\TextColumn::make('Total_Pemasukan')
                    ->label('Total Pemasukan')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state ?? 0, 2, ',', '.'))
                    ->summarize(
                        Sum::make()
                            ->label('Total Pemasukan')
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state ?? 0, 2, ',', '.'))
                    ),
                Tables\Columns\TextColumn::make('total')
                    ->label('Jumlah Terjual')
                    ->formatStateUsing(fn($state) => number_format($state ?? 0, 0, ',', '.'))
                    ->summarize(
                        Sum::make()
                            ->label('Total Produk USG Terjual')
                            ->formatStateUsing(fn($state) => number_format($state ?? 0, 0, ',', '.'))
                    ),
            ]);
    }
}
