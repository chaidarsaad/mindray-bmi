<?php

namespace App\Filament\Resources\TrainingTypeResource\Pages;

use App\Filament\Resources\TrainingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTrainingType extends CreateRecord
{
    protected static string $resource = TrainingTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Buat Jenis Pelatihan';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
