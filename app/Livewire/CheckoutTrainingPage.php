<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingOrder;
use App\Models\TrainingPrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;


class CheckoutTrainingPage extends Component
{
    public $training;
    public $trainingPricesANC = [];
    public $trainingPricesAbdomen = [];

    public $name = '';
    public $email = '';
    public $phone_number = '';
    public $selected_anc = '';
    public $selected_abdomen = '';
    public $total_harga;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|digits_between:11,15',
        'selected_anc' => 'required|exists:training_prices,id',
        'selected_abdomen' => 'required|exists:training_prices,id'
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'phone_number.required' => 'Nomor HP wajib diisi',
        'phone_number.numeric' => 'Nomor HP harus berupa angka',
        'phone_number.digits_between' => 'Nomor HP harus memiliki 11-15 angka',
        'selected_anc.required' => 'Pelatihan ANC wajib dipilih',
        'selected_abdomen.required' => 'Pelatihan Abdomen wajib dipilih'
    ];

    public function checkout()
    {
        try {
            $validateData = $this->validate();

            $anc = TrainingPrice::findOrFail($this->selected_anc);
            $abdomen = TrainingPrice::findOrFail($this->selected_abdomen);

            if (\Carbon\Carbon::parse($anc->start_date)->isPast()) {
                $this->dispatch('notify-error', message: 'Pelatihan ANC yang dipilih sudah terselenggara.');
                return;
            }

            if (\Carbon\Carbon::parse($abdomen->start_date)->isPast()) {
                $this->dispatch('notify-error', message: 'Pelatihan Abdomen yang dipilih sudah terselenggara.');
                return;
            }

            $this->total_harga = $anc->price + $abdomen->price;
            DB::beginTransaction();
            $user = Auth::user();

            if (empty($user->phone_number) || $user->phone_number !== $this->phone_number) {
                $user->update(['phone_number' => $this->phone_number]);
            }
            $order = TrainingOrder::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(12)),
                'total_harga' => $this->total_harga,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone_number,
            ]);

            $order->orderDetails()->createMany([
                ['training_price_id' => $anc->id],
                ['training_price_id' => $abdomen->id],
            ]);

            DB::commit();
            // session()->flash('notify-success', 'Pendaftaran berhasil! Silakan lanjut ke pembayaran.');

            $this->redirectRoute('detail.training.order', ['order' => $order]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessage = collect($e->validator->errors()->all())->first();
            $this->dispatch('notify-error', message: $errorMessage);
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            $this->dispatch('notify-error', message: 'Terjadi kesalahan saat menyimpan data. Coba lagi.');
            return;
        }
    }

    public function mount($slug)
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone_number = Auth::user()->phone_number ?? '';
        $this->training = Training::where('slug', $slug)->firstOrFail();

        $this->trainingPricesANC = $this->training->trainingPrices()
            ->whereHas('trainingType', function ($query) {
                $query->where('slug', 'anc');
            })
            ->with(['city', 'trainingType'])
            ->get()
            ->map(function ($price) {
                // Menambahkan flag untuk mengecek apakah start_date sudah lewat
                $price->is_past = \Carbon\Carbon::parse($price->start_date)->isPast();
                return $price;
            });

        $this->trainingPricesAbdomen = $this->training->trainingPrices()
            ->whereHas('trainingType', function ($query) {
                $query->where('slug', 'abdomen');
            })
            ->with(['city', 'trainingType'])
            ->get()
            ->map(function ($price) {
                // Menambahkan flag untuk mengecek apakah start_date sudah lewat
                $price->is_past = \Carbon\Carbon::parse($price->start_date)->isPast();
                return $price;
            });
    }

    public function render()
    {
        return view('livewire.checkout-training-page');
    }
}
