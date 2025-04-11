<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use App\Models\TrainingOrder;
use Livewire\Component;

class TrainingPaymentPage extends Component
{
    public TrainingOrder $order;
    public $firstTraining;
    public $orderDetailsFormatted = [];
    public $paymentMethods;


    public function mount(TrainingOrder $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('home')->with('notify-error', 'Pesanan tidak ditemukan.');
        }
        $this->paymentMethods = PaymentMethod::all();

        $order->load('orderDetails.trainingPrice.training', 'orderDetails.trainingPrice.trainingType', 'orderDetails.trainingPrice.city');

        $this->order = $order;

        $firstDetail = $order->orderDetails->first();
        if ($firstDetail && $firstDetail->trainingPrice && $firstDetail->trainingPrice->training) {
            $this->firstTraining = $firstDetail->trainingPrice->training;
        }

        // Format detail untuk dipakai langsung di Blade
        $this->orderDetailsFormatted = $order->orderDetails->map(function ($detail) {
            $price = $detail->trainingPrice;
            return [
                'jenis'     => $price->trainingType->name ?? '-',
                'kota'      => $price->city->name ?? '-',
                'tempat'    => $price->place ?? '-',
                'jadwal'    => [
                    'start' => \Carbon\Carbon::parse($price->start_date)->format('d'),
                    'end'   => \Carbon\Carbon::parse($price->end_date)->format('d M Y'),
                ],
                'harga'     => $price->price ?? 0,
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.training-payment-page');
    }
}
