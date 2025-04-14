<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailProductPage extends Component
{
    public $product;
    public $otherProducts;
    public $productDescriptions;
    public $about;
    public $whatsappMessage;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $this->otherProducts = Product::where('id', '!=', $this->product->id)->get();
        $this->productDescriptions = $this->product->descriptions;

        $this->about = About::first();
        if (Auth::check()) {
            $user = Auth::user();
            $this->whatsappMessage =  'Halo admin 👋,%0A%0A' .
                'Saya tertarik untuk memesan alat USG berikut:%0A%0A' .
                '🛒 Nama Produk: ' . $this->product->name . '%0A%0A' .
                'Berikut data saya:%0A' .
                '👤 Nama: ' . $user->name . '%0A' .
                '📧 Email: ' . $user->email . '%0A%0A' .
                'Mohon informasi lebih lanjut, terima kasih 🙏';
        } else {
            $this->whatsappMessage = null;
        }
    }
    public function render()
    {
        return view('livewire.detail-product-page');
    }
}
