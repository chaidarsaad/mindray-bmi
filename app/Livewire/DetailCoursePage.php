<?php

namespace App\Livewire;

use App\Models\Training;
use Livewire\Component;

class DetailCoursePage extends Component
{
    public $training;

    public function mount($slug)
    {
        $this->training = Training::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.detail-course-page');
    }
}
