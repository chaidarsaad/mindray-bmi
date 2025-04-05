<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Product;
use App\Models\Training;
use App\Models\User;
use App\Models\Visit;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk USG', Product::count()),
            Stat::make('Total Pelatihan', Training::count()),
            Stat::make('Total Artikel', Article::count()),
            Stat::make('Jumlah Customer Terdaftar', User::doesntHave('roles')->count()),
            Stat::make('Jumlah Pengunjung Bulan Ini', Visit::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->distinct('ip_address')
                ->count('ip_address')),
        ];
    }
}
