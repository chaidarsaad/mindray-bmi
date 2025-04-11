<?php

namespace App\Livewire;

use App\Models\TrainingOrder;
use Livewire\Component;
use App\Models\PaymentMethod;
use App\Services\OrderStatusService;
use Carbon\Carbon;

class DetailOrderTrainingPage extends Component
{
    public TrainingOrder $order;
    public $firstTraining;
    public $orderDetailsFormatted = [];
    public $paymentMethods;
    public $paymentDeadline;

    public function mount(TrainingOrder $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('home')->with('notify-error', 'Pesanan tidak ditemukan.');
        }

        $this->paymentDeadline = Carbon::parse($this->order->created_at)->addHours(24);

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
                    'end'   => \Carbon\Carbon::parse($price->end_date)->format('d F Y'),
                ],
                'harga'     => $price->price ?? 0,
            ];
        })->toArray();
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

        return view('livewire.detail-order-training-page', [
            'statusInfo' => $statusInfo,
        ]);
    }
}
