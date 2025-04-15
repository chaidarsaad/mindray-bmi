<?php

namespace App\Filament\Resources\TrainingOrderResource\Pages;

use App\Filament\Resources\TrainingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTrainingOrder extends CreateRecord
{
    protected static string $resource = TrainingOrderResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Buat Pesanan Pelatihan';
    }
    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = \App\Models\User::find($data['user_id']);
        if ($user && !empty($data['phone'])) {
            $user->phone_number = $data['phone'];
            $user->save();
        }

        return $data;
    }
}
