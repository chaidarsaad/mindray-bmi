<?php

namespace App\Livewire\Components;

use App\Models\Carousel as ModelsCarousel;
use Livewire\Component;

class Carousel extends Component
{
    public $banners;
    public function mount()
    {
        $this->banners = ModelsCarousel::where('is_show', 1)
            ->orderByDesc('is_priority')
            ->get();
    }
    public function render()
    {
        return view('livewire.components.carousel');
    }
}
