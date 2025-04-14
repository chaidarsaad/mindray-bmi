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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->trainingPriceIds = $data['training_price_ids'] ?? [];
        unset($data['training_price_ids']);

        return $data;
    }

    protected function afterSave(): void
    {
        $this->record->orderDetails()->delete();

        foreach ($this->trainingPriceIds as $priceId) {
            $this->record->orderDetails()->create([
                'training_price_id' => $priceId,
            ]);
        }
    }

    protected function fillForm(): void
    {
        parent::fillForm();

        $trainingPriceIds = $this->record->orderDetails()->pluck('training_price_id')->toArray();
        $totalHarga = \App\Models\TrainingPrice::whereIn('id', $trainingPriceIds)->sum('price');

        $this->form->fill(array_merge(
            $this->form->getState(),
            [
                'training_price_ids' => $trainingPriceIds,
                'total_harga' => $totalHarga,
            ]
        ));
    }
}
