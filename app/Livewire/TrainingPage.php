<?php

namespace App\Livewire;

use App\Models\Training;
use Livewire\Component;

class TrainingPage extends Component
{
    public $trainings;
    public function mount()
    {
        $this->trainings = Training::where('is_show', 1)
            ->join('training_prices', 'trainings.id', '=', 'training_prices.training_id')
            ->orderByDesc('training_prices.start_date')
            ->select('trainings.*') // Pilih kolom dari tabel trainings
            ->distinct() // Menghindari duplikasi
            ->get();
    }
    public function render()
    {
        return view('livewire.training-page');
    }
}
