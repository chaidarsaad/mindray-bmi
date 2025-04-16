<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingOrder;
use App\Models\TrainingPrice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class CheckoutTrainingPage extends Component
{
    public $training;
    public $trainingPricesANC     = [];
    public $trainingPricesAbdomen = [];

    public $name             = '';
    public $email            = '';
    public $phone_number     = '';
    public $selected_anc     = '';
    public $selected_abdomen = '';
    public $total_harga;

    protected $rules = [
        'name'             => 'required|min:3',
        'email'            => 'required|email',
        'phone_number'     => 'required|numeric|digits_between:11,15',
        'selected_anc'     => 'nullable|exists:training_prices,id',
        'selected_abdomen' => 'nullable|exists:training_prices,id',
    ];

    protected $messages = [
        'name.required'               => 'Nama wajib diisi',
        'name.min'                    => 'Nama minimal 3 karakter',
        'email.required'              => 'Email wajib diisi',
        'email.email'                 => 'Format email tidak valid',
        'phone_number.required'       => 'Nomor HP wajib diisi',
        'phone_number.numeric'        => 'Nomor HP harus berupa angka',
        'phone_number.digits_between' => 'Nomor HP harus memiliki 11-15 angka',
        'selected_anc.exists'         => 'Pelatihan ANC tidak valid',
        'selected_abdomen.exists'     => 'Pelatihan Abdomen tidak valid',
    ];

    public function checkout()
    {
        try {
            $validateData = $this->validate();

            if (!$this->selected_anc && !$this->selected_abdomen) {
                $this->dispatch('notify-error', message: 'Pilih minimal satu jenis pelatihan.');
                return;
            }

            $anc = !empty($this->selected_anc) ? TrainingPrice::findOrFail($this->selected_anc) : null;
            $abdomen = !empty($this->selected_abdomen) ? TrainingPrice::findOrFail($this->selected_abdomen) : null;

            if ($anc && Carbon::parse($anc->start_date)->isPast()) {
                $this->dispatch('notify-error', message: 'Pelatihan ANC yang dipilih sudah terselenggara.');
                return;
            }

            if ($abdomen && Carbon::parse($abdomen->start_date)->isPast()) {
                $this->dispatch('notify-error', message: 'Pelatihan Abdomen yang dipilih sudah terselenggara.');
                return;
            }

            $this->total_harga = 0;
            $orderDetails = [];

            if ($anc) {
                $this->total_harga += $anc->price;
                $orderDetails[] = ['training_price_id' => $anc->id];
            }

            if ($abdomen) {
                $this->total_harga += $abdomen->price;
                $orderDetails[] = ['training_price_id' => $abdomen->id];
            }

            DB::beginTransaction();
            $user = Auth::user();

            if (empty($user->phone_number) || $user->phone_number !== $this->phone_number) {
                $user->update(['phone_number' => $this->phone_number]);
            }

            $order = TrainingOrder::create([
                'user_id'        => auth()->id(),
                'order_number'   => 'ORD-' . strtoupper(Str::random(12)),
                'total_harga'    => $this->total_harga,
                'status'         => 'pending',
                'payment_status' => 'unpaid',
                'name'           => $this->name,
                'email'          => $this->email,
                'phone'          => $this->phone_number,
            ]);

            $order->orderDetails()->createMany($orderDetails);

            DB::commit();

            $this->redirectRoute('detail.training.order', ['order' => $order]);

            $admin = User::role(['super_admin', 'owner'])->get();
            $title = 'Ada pesanan pelatihan baru dari : ' . $order->name;
            $body = "Email: {$order->email}<br>Nomor Hp: {$order->phone}";

            Notification::make()
                ->title($title)
                ->body($body)
                ->actions([
                    Action::make('view')
                        ->label('Lihat')
                        ->url(route('filament.admin.resources.training-orders.edit', $order))
                        ->button()
                        ->markAsRead(),
                ])
                ->sendToDatabase($admin);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessage = collect($e->validator->errors()->all())->first();
            $this->dispatch('notify-error', message: $errorMessage);
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Checkout Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            report($e);
            $this->dispatch('notify-error', message: 'Terjadi kesalahan saat menyimpan data. Coba lagi.');
            return;
        }
    }

    public function mount($slug)
    {
        $this->name         = Auth::user()->name;
        $this->email        = Auth::user()->email;
        $this->phone_number = Auth::user()->phone_number ?? '';
        $this->training     = Training::where('slug', $slug)->firstOrFail();

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
