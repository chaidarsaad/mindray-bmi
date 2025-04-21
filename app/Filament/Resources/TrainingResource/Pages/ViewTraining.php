<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Resources\Pages\Page;

class ViewTraining extends Page
{
    protected static string $resource = TrainingResource::class;
    protected static string $view = 'filament.resources.training-resource.pages.view-training';

    public $record;
    public $trainingPrices;

    public function mount($record): void
    {
        $this->record = TrainingResource::getModel()::with([
            'trainingPrices.city',
            'trainingPrices.trainingType',
            'trainingPrices.orderDetails.trainingOrder.user',
        ])->whereSlug($record)->firstOrFail();

        $this->trainingPrices = $this->record->trainingPrices;
    }
}
