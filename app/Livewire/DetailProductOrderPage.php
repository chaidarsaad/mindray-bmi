<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use App\Models\ProductOrder;
use App\Services\OrderStatusService;
use Livewire\Component;

class DetailProductOrderPage extends Component
{
    public $paymentMethods;
    public $paymentDeadline;
    public ProductOrder $order;

    public function mount(ProductOrder $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('home')->with('notify-error', 'Pesanan tidak ditemukan.');
        }

        $this->paymentDeadline = now()->addHours(24);
        $this->paymentMethods = PaymentMethod::all();
        $this->order = $order;
    }

    public function getStatusInfo()
    {
        return OrderStatusService::getStatusInfo(
            $this->order->status,
            $this->paymentDeadline,
            $this->order->completed_at,
        );
    }

    public function render()
    {
        $statusInfo = $this->getStatusInfo();

        return view('livewire.detail-product-order-page', [
            'statusInfo' => $statusInfo,
        ]);
    }
}
