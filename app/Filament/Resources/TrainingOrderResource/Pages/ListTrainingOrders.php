<?php

namespace App\Filament\Resources\TrainingOrderResource\Pages;

use App\Filament\Resources\TrainingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrainingOrders extends ListRecords
{
    protected static string $resource = TrainingOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
