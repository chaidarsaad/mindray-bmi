<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTestimonial extends CreateRecord
{
    protected static string $resource = TestimonialResource::class;
    public function getTitle(): string | Htmlable
    {
        return 'Buat Testimonial';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
