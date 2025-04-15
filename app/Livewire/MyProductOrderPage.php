<?php

namespace App\Livewire;

use App\Models\ProductOrder;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class MyProductOrderPage extends Component
{
    use WithPagination;
    public $perPage = 5;

    public function render()
    {
        $orders = ProductOrder::where('user_id', Auth::id())
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.my-product-order-page', [
            'orders' => $orders
        ]);
    }
}
