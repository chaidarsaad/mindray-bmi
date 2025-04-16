<?php

namespace App\Livewire;

use App\Models\Training;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrainingPage extends Component
{
    public $trainings;
    public function mount()
    {
        // $this->trainings = Training::where('is_show', 1)
        //     ->join('training_prices', 'trainings.id', '=', 'training_prices.training_id')
        //     ->orderByDesc('training_prices.start_date')
        //     ->select('trainings.*') // Pilih kolom dari tabel trainings
        //     ->distinct() // Menghindari duplikasi
        //     ->get();

        $this->trainings = Training::where('is_show', 1)
            ->join(
                DB::raw('(SELECT training_id, MAX(start_date) as latest_start_date FROM training_prices GROUP BY training_id) as tp'),
                'trainings.id',
                '=',
                'tp.training_id'
            )
            ->orderByDesc('tp.latest_start_date')
            ->select('trainings.*', 'tp.latest_start_date')
            ->limit(4)
            ->get();
    }
    public function render()
    {
        return view('livewire.training-page');
    }
}
