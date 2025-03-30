<?php

namespace App\Filament\Resources\TrainingTypeResource\Pages;

use App\Filament\Resources\TrainingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTrainingType extends EditRecord
{
    protected static string $resource = TrainingTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Ubah Jenis Pelatihan';
    }
    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
