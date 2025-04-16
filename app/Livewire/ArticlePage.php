<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlePage extends Component
{
    use WithPagination;
    public $perPage = 1;

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
