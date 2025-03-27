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
            ->orderBy('tanggal', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.training-page');
    }
}
