<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use App\Models\TrainingOrder;
use Livewire\Component;

class TrainingPaymentPage extends Component
{
    public TrainingOrder $order;
    public $paymentMethods;


    public function mount(TrainingOrder $order)
    {
        $this->order = $order;
        $this->paymentMethods = PaymentMethod::all();
    }
    public function render()
    {
        return view('livewire.training-payment-page');
    }
}
