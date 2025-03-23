<?php

namespace App\Livewire\Components;

use App\Models\About;
use Livewire\Component;

class Whatsapp extends Component
{
    public $about;
    public function mount()
    {
        $this->about = About::first();
    }
    public function render()
    {
        return view('livewire.components.whatsapp');
    }
}
