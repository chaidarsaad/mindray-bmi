<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function mount(): void
    {
        $this->filters['startDate'] ??= now()->startOfMonth()->toDateString();
        $this->filters['endDate'] ??= now()->toDateString();
    }

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Tanggal Mulai')
                            ->native(false)
                            ->displayFormat('l, d F Y')
                            ->maxDate(fn(Get $get) => $get('endDate') ?: now())
                            ->default(now()->startOfMonth()),

                        DatePicker::make('endDate')
                            ->label('Tanggal Akhir')
                            ->default(now())
                            ->native(false)
                            ->displayFormat('l, d F Y')
                            ->minDate(fn(Get $get) => $get('startDate') ?: now()->startOfMonth())
                            ->maxDate(now()),
                    ])
                    ->columns(2),
            ]);
    }
}
