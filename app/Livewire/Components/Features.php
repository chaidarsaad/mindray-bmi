<?php

namespace App\Livewire\Components;

use App\Models\Feature;
use Livewire\Component;

class Features extends Component
{
    public $features;
    public function mount()
    {
        $this->features = Feature::all();
    }
    public function render()
    {
        return view('livewire.components.features');
    }
}
