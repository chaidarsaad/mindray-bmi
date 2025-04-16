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
        // $this->trainings = ModelsTraining::where('is_show', 1)
        //     ->join('training_prices', 'trainings.id', '=', 'training_prices.training_id')
        //     ->orderByDesc('training_prices.start_date')
        //     ->select('trainings.*')
        //     ->distinct()
        //     ->take(4)
        //     ->get();
        $this->trainings = ModelsTraining::where('is_show', 1)
            ->join(DB::raw('(SELECT training_id, MAX(start_date) as latest_date FROM training_prices GROUP BY training_id) as tp'), 'trainings.id', '=', 'tp.training_id')
            ->orderByDesc('tp.latest_date')
            ->select('trainings.*', 'tp.latest_date')
            ->take(4)
            ->get();
    }
    public function render()
    {
        return view('livewire.components.training');
    }
}
