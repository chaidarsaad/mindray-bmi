<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Expense;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Training;
use App\Models\TrainingOrder;
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

    protected static bool $isLazy = false;
    use HasWidgetShield, InteractsWithPageFilters;
    protected function getStats(): array
    {
        $startDate = !empty($this->filters['startDate'])
            ? \Carbon\Carbon::parse($this->filters['startDate'])->startOfDay()
            : \Carbon\Carbon::create(2025, 1, 1);

        $endDate = !empty($this->filters['endDate'])
            ? \Carbon\Carbon::parse($this->filters['endDate'])->endOfDay()
            : now()->endOfDay();

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

        $totalPemasukan = TrainingOrder::query()
            ->where('payment_status', 'paid')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->sum('total_harga');

        $totalPemasukan += ProductOrder::query()
            ->where('payment_status', 'paid')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->sum('total_harga');

        $totalLaba = $totalPemasukan - $pengeluaran;
        $totalProducts = Product::count();
        $totalTrainings = Training::count();
        $totalArticles = Article::count();
        $totalPesertaPelatihan = TrainingOrder::query()
            ->where('payment_status', 'paid')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->distinct('user_id')
            ->count('user_id');


        return [
            Stat::make('Total Produk USG', $totalProducts)
                ->url(route('filament.admin.resources.produk-usg.index'))
                ->description('klik untuk melihat semua produk'),
            Stat::make('Total Pelatihan', $totalTrainings)
                ->url(route('filament.admin.resources.pelatihan.index'))
                ->description('klik untuk melihat semua pelatihan'),
            Stat::make('Total Peserta Pelatihan', $totalPesertaPelatihan)
                ->description('jumlah orang yang mengikuti pelatihan, klik untuk melihat peserta')
                ->url(route('filament.admin.resources.pelatihan.index')),
            Stat::make('Total Artikel', $totalArticles)
                ->url(route('filament.admin.resources.artikel.index'))
                ->description('klik untuk melihat semua artikel'),
            Stat::make('Jumlah Customer Terdaftar', $jumlahCustomer),
            Stat::make('Jumlah Pengunjung', $pengunjung),
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($pengeluaran, 0, ",", ","))
                ->url(route('filament.admin.resources.pengeluaran.index'))
                ->description('klik untuk melihat semua pengeluaran'),
            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalPemasukan, 0, ",", ","))
                ->description('total pemasukan dari pelatihan dan produk USG'),
            Stat::make('Total Laba', 'Rp ' . number_format($totalLaba, 0, ",", ","))
                ->description('total laba bersih dari pelatihan dan produk USG'),
        ];
    }
}
