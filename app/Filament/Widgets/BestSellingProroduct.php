<?php

namespace App\Filament\Widgets;

use App\Models\ProductOrder;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Database\Eloquent\Builder;

class BestSellingProroduct extends BaseWidget
{
    use InteractsWithPageFilters, HasWidgetShield;

    protected static ?string $heading = 'Alat USG Terjual';
    protected static ?int $sort = 1;

    public function getTableRecordKey($record): string
    {
        // Menggunakan product_id sebagai kunci unik
        return (string) $record->product_id;
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions([5, 10, 25, 50, 100, 250])
            ->defaultPaginationPageOption(5)
            ->query(function (): Builder {
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfDay();

                if (!empty($this->filters['startDate'])) {
                    $startDate = \Carbon\Carbon::parse($this->filters['startDate']);
                }

                if (!empty($this->filters['endDate'])) {
                    $endDate = \Carbon\Carbon::parse($this->filters['endDate'])->endOfDay();
                }

                return ProductOrder::query()
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->where('payment_status', 'paid')  // Hanya memilih yang status pembayaran "paid"
                    ->selectRaw('product_id, count(*) as total, sum(total_harga) as total_revenue')  // Menghitung jumlah produk dan total pendapatan
                    ->groupBy('product_id')  // Mengelompokkan berdasarkan product_id
                    ->with(['product'])  // Memuat relasi produk
                    ->orderByDesc('total');
            })
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Nama Produk')
                    ->limit(20),
                Tables\Columns\TextColumn::make('total')
                    ->label('Jumlah Terjual'),
                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Total Pendapatan')
                    ->money('IDR', true),
            ]);
    }
}
