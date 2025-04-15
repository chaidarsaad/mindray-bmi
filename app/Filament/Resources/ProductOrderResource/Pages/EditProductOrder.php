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
}
