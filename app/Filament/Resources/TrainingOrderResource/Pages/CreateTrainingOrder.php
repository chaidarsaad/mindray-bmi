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
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->trainingPriceIds = $data['training_price_ids'] ?? [];
        unset($data['training_price_ids']);

        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->trainingPriceIds as $priceId) {
            $this->record->orderDetails()->create([
                'training_price_id' => $priceId,
                // tambahkan field lain jika perlu
            ]);
        }
    }
}
