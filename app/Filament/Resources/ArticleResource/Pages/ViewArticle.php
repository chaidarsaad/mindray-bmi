<?php

namespace App\Filament\Resources\ArticleResource\Pages;


use App\Filament\Resources\ArticleResource;
use Filament\Actions\EditAction;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    protected static string $view = 'filament.resources.articles.view'; // ⬅️ cukup ini

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make('edit')
                ->url(fn() => static::getResource()::getUrl('edit', ['record' => $this->record])),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'article' => $this->record,
        ];
    }
}
