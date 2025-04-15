<?php

namespace App\Filament\Resources\ProductOrderResource\Pages;

use App\Filament\Resources\ProductOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateProductOrder extends CreateRecord
{
    protected static string $resource = ProductOrderResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Buat Pesanan Produk USG';
    }

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
}
