<?php

namespace App\Livewire;

use App\Models\TrainingOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersPage extends Component
{
    use WithPagination;

    public $perPage = 5;

    public function render()
    {
        $orders = TrainingOrder::withCount('orderDetails')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.my-orders-page', [
            'orders' => $orders
        ]);
    }
}
