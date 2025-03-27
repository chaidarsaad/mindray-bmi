<?php

namespace App\Livewire\Components;

use App\Models\Article as ModelsArticle;
use Livewire\Component;

class Article extends Component
{
    public $articles;
    public function mount()
    {
        $this->articles = ModelsArticle::where('is_show', 1)
            ->latest()
            ->get();
    }
    public function render()
    {
        return view('livewire.components.article');
    }
}
