<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Database\Eloquent\Builder;

class BiggestExpenses extends BaseWidget
{
    use InteractsWithPageFilters, HasWidgetShield;

    protected static ?string $heading = 'Pengeluaran Terbesar';
    protected static ?int $sort = 5;
    protected static string $color = 'danger';
    protected int | string | array $columnSpan = 'full';

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

                return Expense::query()
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->orderByDesc('amount');
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Pengeluaran'),
                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->label('Jumlah'),
                Tables\Columns\TextColumn::make('date_expense')
                    ->label('Tanggal Pengeluaran')
                    ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)
                        ->locale('id')
                        ->timezone('Asia/Jakarta')
                        ->translatedFormat('l, d F Y H:i')),
            ]);
    }
}
