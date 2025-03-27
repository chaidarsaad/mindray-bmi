<?php

namespace App\Livewire\Components;

use App\Models\Training as ModelsTraining;
use Livewire\Component;

class Training extends Component
{
    public $trainings;
    public function mount()
    {
        $this->trainings = ModelsTraining::where('is_show', 1)
            ->orderBy('tanggal', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.components.training');
    }
}
