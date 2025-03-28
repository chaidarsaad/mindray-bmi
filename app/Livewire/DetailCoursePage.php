<?php

namespace App\Livewire;

use App\Models\Training;
use Livewire\Component;

class DetailCoursePage extends Component
{
    public $training;
    public $isPastDate = false;
    public function mount($slug)
    {
        $this->training = Training::where('slug', $slug)->firstOrFail();
        $tanggal_training = strtotime($this->training->tanggal);
        $tanggal_sekarang = time();

        $this->isPastDate = ($tanggal_training < $tanggal_sekarang);
    }

    public function render()
    {
        return view('livewire.detail-course-page');
    }
}
