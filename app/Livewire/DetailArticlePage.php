<?php

namespace App\Livewire;

use App\Models\About;
use App\Models\Article;
use App\Models\PaymentMethod;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;

class DetailArticlePage extends Component
{
    public $article;
    public $otherArticle;
    public $about;
    public $shouldRedirect = false;

    public function mount($slug)
    {
        $this->about = About::first();

        $this->article = Article::with('tags', 'user')
            ->where('slug', $slug)
            ->firstOrFail();
        if ($this->article->is_show == 0) {
            return redirect()->route('home');
        }
        $this->otherArticle = Article::where('id', '!=', $this->article->id)->with('tags', 'user')->get();

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
