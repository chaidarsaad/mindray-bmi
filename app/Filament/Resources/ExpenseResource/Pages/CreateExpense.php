<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Buat Pengeluaran';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
