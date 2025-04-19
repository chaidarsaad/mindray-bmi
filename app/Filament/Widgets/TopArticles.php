<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopArticles extends BaseWidget
{
    use InteractsWithPageFilters, HasWidgetShield;
    protected static ?string $heading = 'Artikel Teratas';
    protected static ?string $description = 'Artikel yang paling banyak dibaca';
    protected static ?int $sort = 3;
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
                    $startDate = Carbon::parse($this->filters['startDate']);
                }

                if (!empty($this->filters['endDate'])) {
                    $endDate = Carbon::parse($this->filters['endDate'])->endOfDay();
                }

                return Article::query()
                    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->orderByDesc('views'); // views langsung dari kolom
            })
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label('Penulis'),
                Tables\Columns\TextColumn::make('views')
                    ->label('Jumlah Dilihat'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('l, d F Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading(fn($record) => $record->judul)
                    ->modalContent(function ($record) {
                        return view('filament.widgets.view-article', [
                            'record' => $record,
                        ]);
                    }),
                Tables\Actions\EditAction::make()
                    ->url(fn($record) => route('filament.admin.resources.articles.edit', ['record' => $record])),
            ]);
    }
}
