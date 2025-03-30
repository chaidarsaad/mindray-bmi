<?php

namespace App\Livewire\Components;

use App\Models\Training as ModelsTraining;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Training extends Component
{
    public $trainings;
    public $lastDateTraining;
    public function mount()
    {
        $this->trainings = ModelsTraining::where('is_show', 1)
            ->orderBy('tanggal', 'desc')
            ->get();
        $this->lastDateTraining = ModelsTraining::where('is_show', 1)
            ->with('trainingPrices')
            ->get();
    }
    public function render()
    {
        // dd($this->lastDateTraining);
        return view('livewire.components.training');
    }
}
