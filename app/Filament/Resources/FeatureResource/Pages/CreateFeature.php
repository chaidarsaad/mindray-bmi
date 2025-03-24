<?php

namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateFeature extends CreateRecord
{
    protected static string $resource = FeatureResource::class;
    public function getTitle(): string | Htmlable
    {
        return 'Buat Kelebihan';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
