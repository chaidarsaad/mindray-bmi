<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use App\Models\TrainingOrder;
use App\Services\OrderStatusService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TrainingPaymentPage extends Component
{
    public TrainingOrder $order;
    public $firstTraining;
    public $orderDetailsFormatted = [];
    public $paymentMethods;
    use WithFileUploads;
    public $payment_proof;

    protected $rules = [
        'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ];

    protected $messages = [
        'payment_proof.required' => 'Harap upload bukti transfer',
        'payment_proof.image'    => 'File harus berupa gambar',
        'payment_proof.mimes'    => 'Format gambar harus jpg, jpeg, atau png',
        'payment_proof.max'      => 'Ukuran file maksimal 2MB',
    ];


    public function updatedPaymentProof()
    {
        $this->validate([
            'payment_proof' => 'image|max:2048'
        ]);
    }

    public function submit()
    {

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessage = collect($e->validator->errors()->all())->first();
            $this->dispatch('notify-error', message: $errorMessage);
            return;
        }

        // Ambil data user & order
        $userName    = Str::slug(auth()->user()->name);
        $orderNumber = $this->order->order_number;
        $extension   = $this->payment_proof->getClientOriginalExtension();

        // Bentuk nama file: bukti-pembayaran-namauser-ordernumber.ext
        $filename = "bukti-pembayaran-{$userName}-{$orderNumber}.{$extension}";

        // Upload dengan nama file tersebut
        $path = $this->payment_proof->storeAs('payment-proofs', $filename, 'public');

        // Simpan path ke DB
        $this->order->update([
            'payment_proof' => $path,
            'status' => OrderStatusService::PAYMENT_VERIFYING,
        ]);

        session()->flash('notify-success', 'Bukti pembayaran berhasil diunggah.');

        $this->redirectRoute('detail.training.order', ['order' => $this->order]);
    }

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
                'jenis'  => $price->trainingType->name ?? '-',
                'kota'   => $price->city->name ?? '-',
                'tempat' => $price->place ?? '-',
                'jadwal' => [
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
