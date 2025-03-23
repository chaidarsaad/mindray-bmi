<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Buat Pertanyaan';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
