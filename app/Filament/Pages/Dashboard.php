<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm, HasWidgetShield;

    public function mount(): void
    {
        $this->filters['startDate'] ??= null;
        $this->filters['endDate'] ??= now()->toDateString();
    }

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Filter berdasarkan tanggal')
                    ->collapsible()
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Tanggal Mulai')
                            ->native(false)
                            ->displayFormat('l, d F Y')
                            ->placeholder('Pilih Tanggal')
                            ->maxDate(fn(Get $get) => $get('endDate') ?: now()),
                        DatePicker::make('endDate')
                            ->label('Tanggal Akhir')
                            ->placeholder('Pilih Tanggal')
                            ->native(false)
                            ->displayFormat('l, d F Y')
                            ->minDate(fn(Get $get) => $get('startDate') ?: now()->startOfMonth())
                            ->maxDate(now())
                            ->default(fn() => now()->endOfDay())
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
