<?php

namespace App\Livewire;

use App\Models\TrainingOrder;
use Livewire\Component;

class DetailOrderTrainingPage extends Component
{
    public TrainingOrder $order;
    public $firstTraining;
    public $orderDetailsFormatted = [];

    public function mount(TrainingOrder $order)
    {
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
        return view('livewire.detail-order-training-page');
    }
}
