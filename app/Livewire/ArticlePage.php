<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticlePage extends Component
{
    public $articles;
    public function mount()
    {
        $this->articles = Article::where('is_show', 1)->get();
    }
    public function render()
    {
        return view('livewire.article-page');
    }
}
