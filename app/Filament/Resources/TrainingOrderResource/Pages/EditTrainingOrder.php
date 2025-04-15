<?php

namespace App\Filament\Resources\TrainingOrderResource\Pages;

use App\Filament\Resources\TrainingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTrainingOrder extends EditRecord
{
    protected static string $resource = TrainingOrderResource::class;
    protected array $trainingPriceIds = [];

    public function getTitle(): string|\Illuminate\Support\HtmlString
    {
        return 'Ubah Pesanan Pelatihan';
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
}
