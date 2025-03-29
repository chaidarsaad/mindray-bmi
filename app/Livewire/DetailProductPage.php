<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class DetailProductPage extends Component
{
    public $product;
    public $otherProducts;
    public $productDescriptions;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $this->otherProducts = Product::where('id', '!=', $this->product->id)->get();
        $this->productDescriptions = $this->product->descriptions;
    }
    public function render()
    {
        return view('livewire.detail-product-page');
    }
}
