<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateAbout extends CreateRecord
{
    protected static bool $canCreateAnother = false;
    protected static string $resource = AboutResource::class;
    public function getTitle(): string | Htmlable
    {
        return 'Buat CV';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
