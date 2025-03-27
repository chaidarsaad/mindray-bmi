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

        $sessionKey = 'article_viewed_' . $this->article->id;
        if (!session()->has($sessionKey)) {
            $this->article->increment('views');
            session([$sessionKey => true]);
        }
    }
    public function render()
    {
        return view('livewire.detail-article-page');
    }
}
