<?php

namespace App\Filament\Resources\TrainingOrderResource\Pages;

use App\Filament\Resources\TrainingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTrainingOrder extends CreateRecord
{
    protected static string $resource = TrainingOrderResource::class;
    protected array $trainingPriceIds = [];

    public function getTitle(): string | Htmlable
    {
        return 'Buat Pesanan Pelatihan';
    }
    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
}
