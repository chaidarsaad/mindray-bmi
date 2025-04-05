<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $categories;
    public function mount()
    {
        $this->categories = Category::with(['products' => function ($query) {
            $query->where('is_show', 1);
        }])
            ->get()
            ->filter(function ($category) {
                return $category->products->isNotEmpty();
            })
            ->values();
    }
    public function render()
    {
        return view('livewire.components.product');
    }
}
