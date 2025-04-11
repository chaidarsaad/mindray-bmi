<?php

namespace App\Livewire;

use App\Models\TrainingOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyOrdersPage extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = TrainingOrder::withCount('orderDetails')
            ->where('user_id', Auth::id())
            ->get();
    }
    public function render()
    {
        return view('livewire.my-orders-page');
    }
}
