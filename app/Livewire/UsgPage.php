<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Product as ModelsProduct;
use Livewire\Component;

class UsgPage extends Component
{
    public $products;
    public $about;
    public function mount()
    {
        $this->about = About::first();

        $this->products = ModelsProduct::where('is_show', 1)->get();
    }
    public function render()
    {
        return view('livewire.usg-page');
    }
}
