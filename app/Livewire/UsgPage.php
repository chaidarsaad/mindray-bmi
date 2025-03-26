<?php

namespace App\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class UsgPage extends Component
{
    public $products;
    public function mount()
    {
        $this->products = ModelsProduct::where('is_show', 1)->get();
    }
    public function render()
    {
        return view('livewire.usg-page');
    }
}
