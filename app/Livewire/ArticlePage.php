<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlePage extends Component
{
    use WithPagination;
    public $perPage = 6;
    public $about;

    public function mount()
    {
        $this->about = About::first();
    }

    public function render()
    {
        $articles = Article::where('is_show', 1)
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.article-page', [
            'articles' => $articles
        ]);
    }
}
