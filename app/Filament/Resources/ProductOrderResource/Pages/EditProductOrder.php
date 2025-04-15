<?php

namespace App\Filament\Resources\ProductOrderResource\Pages;

use App\Filament\Resources\ProductOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductOrder extends EditRecord
{
    protected static string $resource = ProductOrderResource::class;

    public function getTitle(): string|\Illuminate\Support\HtmlString
    {
        return 'Ubah Pesanan Produk USG';
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
