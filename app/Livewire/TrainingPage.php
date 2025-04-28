<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Training;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TrainingPage extends Component
{
    public $perPage = 8;
    public $about;

    public function mount()
    {
        $this->about = About::first();
    }


    public function render()
    {
        $trainings = Training::where('is_show', 1)
            ->join(
                DB::raw('(SELECT training_id, MAX(start_date) as latest_start_date FROM training_prices GROUP BY training_id) as tp'),
                'trainings.id',
                '=',
                'tp.training_id'
            )
            ->orderByDesc('tp.latest_start_date')
            ->select('trainings.*', 'tp.latest_start_date')
            ->paginate($this->perPage);

        return view('livewire.training-page', [
            'trainings' => $trainings
        ]);
    }
}
