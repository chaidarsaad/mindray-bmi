<?php

namespace App\Filament\Widgets;

use App\Models\ProductOrder;
use App\Models\TrainingOrder;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OmsetChart extends ChartWidget
{
    protected static ?string $heading = 'Pemasukan';
    protected static ?int $sort = 4;
    public ?string $filter = 'today';
    protected static string $color = 'success';

    use HasWidgetShield;

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $dateRange = match ($activeFilter) {
            'today' => [
                'start' => now()->startOfDay(),
                'end' => now()->endOfDay(),
                'period' => 'perHour',
            ],
            'week' => [
                'start' => now()->startOfWeek(),
                'end' => now()->endOfWeek(),
                'period' => 'perDay',
            ],
            'month' => [
                'start' => now()->startOfMonth(),
                'end' => now()->endOfMonth(),
                'period' => 'perDay',
            ],
            'year' => [
                'start' => now()->startOfYear(),
                'end' => now()->endOfYear(),
                'period' => 'perMonth',
            ],
        };

        $trainingTrend = Trend::query(
            TrainingOrder::query()->where('payment_status', 'paid')
        )->dateColumn('created_at')
            ->between(start: $dateRange['start'], end: $dateRange['end']);

        $productTrend = Trend::query(
            ProductOrder::query()->where('payment_status', 'paid')
        )->dateColumn('created_at')
            ->between(start: $dateRange['start'], end: $dateRange['end']);

        // Ambil data per periode
        if ($dateRange['period'] === 'perHour') {
            $trainingData = $trainingTrend->perHour()->sum('total_harga');
            $productData = $productTrend->perHour()->sum('total_harga');
        } elseif ($dateRange['period'] === 'perDay') {
            $trainingData = $trainingTrend->perDay()->sum('total_harga');
            $productData = $productTrend->perDay()->sum('total_harga');
        } else {
            $trainingData = $trainingTrend->perMonth()->sum('total_harga');
            $productData = $productTrend->perMonth()->sum('total_harga');
        }

        // Gabungkan data berdasarkan tanggal
        $trainingArray = collect($trainingData)->keyBy(fn(TrendValue $item) => $item->date);
        $productArray = collect($productData)->keyBy(fn(TrendValue $item) => $item->date);

        $allDates = $trainingArray->keys()->merge($productArray->keys())->unique()->sort();

        $combined = $allDates->map(function ($date) use ($trainingArray, $productArray) {
            $training = $trainingArray[$date]->aggregate ?? 0;
            $product = $productArray[$date]->aggregate ?? 0;

            return [
                'date' => $date,
                'aggregate' => $training + $product,
            ];
        });

        $labels = $combined->map(function ($item) use ($dateRange) {
            $date = Carbon::parse($item['date']);
            return match ($dateRange['period']) {
                'perHour' => $date->format('H:i'),
                'perDay' => $date->format('d M'),
                default => $date->format('M Y'),
            };
        });

        $values = $combined->pluck('aggregate');

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan ' . $this->getFilters()[$activeFilter],
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hari ini',
            'week' => 'Minggu ini',
            'month' => 'Bulan ini',
            'year' => 'Tahun ini',
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
