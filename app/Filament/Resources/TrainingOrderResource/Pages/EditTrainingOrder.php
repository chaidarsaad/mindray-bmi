<?php

namespace App\Filament\Resources\TrainingOrderResource\Pages;

use App\Filament\Resources\TrainingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTrainingOrder extends EditRecord
{
    protected static string $resource = TrainingOrderResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Ubah Pesanan Pelatihan';
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
