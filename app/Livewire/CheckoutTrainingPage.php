<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingPrice;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutTrainingPage extends Component
{
    public $training;
    public $trainingPricesANC = [];
    public $trainingPricesAbdomen = [];

    public $registrationTrainingData = [
        'name' => '',
        'email' => '',
        'phone_number' => '',
        'selected_anc' => '',
        'selected_abdomen' => '',
    ];

    public function mount($slug)
    {
        $this->registrationTrainingData['name'] = Auth::user()->name;
        $this->registrationTrainingData['email'] = Auth::user()->email;
        $this->training = Training::where('slug', $slug)->firstOrFail();

        $this->trainingPricesANC = TrainingPrice::whereHas('trainingType', function ($query) {
            $query->where('slug', 'anc');
        })->with(['city', 'trainingType'])->get();

        $this->trainingPricesAbdomen = TrainingPrice::whereHas('trainingType', function ($query) {
            $query->where('slug', 'abdomen');
        })->with(['city', 'trainingType'])->get();
    }

    public function render()
    {
        return view('livewire.checkout-training-page');
    }
}
