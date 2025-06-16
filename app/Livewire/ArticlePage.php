<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlePage extends Component
{
    use WithPagination;
    public $perPage = 9;
    public $about;

    public function mount()
    {
        $this->about = About::first();
    }

    public function render()
    {
        $articles = Article::where('is_show', 1)
            ->orderBy('published_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.article-page', [
            'articles' => $articles
        ]);
    }
}
