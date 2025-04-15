<?php

namespace App\Filament\Resources\TrainingOrderResource\Pages;

use App\Filament\Resources\TrainingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTrainingOrder extends EditRecord
{
    protected static string $resource = TrainingOrderResource::class;

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
