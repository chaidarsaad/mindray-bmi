<?php

namespace App\Livewire;

use App\Models\About;
use Livewire\Component;

class HomePage extends Component
{
    public $about;

    public function mount()
    {
        $this->about = About::first();
    }
    public function render()
    {
        return view('livewire.home-page');
    }
}
