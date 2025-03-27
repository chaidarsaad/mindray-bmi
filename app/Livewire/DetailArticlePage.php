<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class DetailArticlePage extends Component
{
    public $article;
    public $otherArticle;

    public function mount($slug)
    {
        $this->article = Article::where('slug', $slug)->firstOrFail();
        $this->otherArticle = Article::where('id', '!=', $this->article->id)->get();
    }
    public function render()
    {
        return view('livewire.detail-article-page');
    }
}
