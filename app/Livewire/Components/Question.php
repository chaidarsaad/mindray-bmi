<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Question as ModelQuestion;

class Question extends Component
{
    public $questions = [];

    public function mount()
    {
        $this->questions = ModelQuestion::all();
    }

    public function render()
    {
        return view('livewire.components.question');
    }
}
