<?php

namespace App\Livewire\Components;

use App\Models\Testimonial;
use Livewire\Component;

class Testimonials extends Component
{
    public $testimonials;
    public function mount()
    {
        $this->testimonials = Testimonial::where('is_show', 1)->get();
    }
    public function render()
    {
        return view('livewire.components.testimonials');
    }
}
