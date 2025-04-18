<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Training;
use App\Models\User;
use App\Models\Visit;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected ?string $heading = 'Statistik';
    protected static ?int $sort = 0;

    use HasWidgetShield, InteractsWithPageFilters;
    protected function getStats(): array
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfDay();

        if (!empty($this->filters['startDate'])) {
            $startDate = Carbon::parse($this->filters['startDate']);
        }

        if (!empty($this->filters['endDate'])) {
            $endDate = Carbon::parse($this->filters['endDate'])->endOfDay();
        }

        $expenseQuery = Expense::query();
        if ($startDate && $endDate) {
            $expenseQuery->whereBetween('date_expense', [$startDate, $endDate]);
        } elseif ($startDate) {
            $expenseQuery->where('date_expense', '>=', $startDate);
        } elseif ($endDate) {
            $expenseQuery->where('date_expense', '<=', $endDate);
        }

        $pengeluaran = $expenseQuery->sum('amount');
        $pengunjung = Visit::query()
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->distinct('ip_address')
            ->count('ip_address');
        $jumlahCustomer = User::query()
            ->doesntHave('roles')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->count();


        return [
            Stat::make('Total Produk USG', Product::count())
                ->url(route('filament.admin.resources.products.index')),
            Stat::make('Total Pelatihan', Training::count())
                ->url(route('filament.admin.resources.trainings.index')),
            Stat::make('Total Artikel', Article::count())
                ->url(route('filament.admin.resources.articles.index')),
            Stat::make('Jumlah Customer Terdaftar', $jumlahCustomer),
            Stat::make('Jumlah Pengunjung', $pengunjung),
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($pengeluaran, 0, ",", ","))
                ->url(route('filament.admin.resources.expenses.index')),
        ];
    }
}
