<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTraining extends CreateRecord
{
    protected static string $resource = TrainingResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Buat Pelatihan';
    }
}
