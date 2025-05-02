<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticlePreviewController extends Controller
{
    public function show(Article $article)
    {
        $user = auth()->user();

        if ($user->roles->isEmpty()) {
            session()->flash('notify-error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->route('home');
        }
        return view('admin.articles.preview', compact('article'));
    }
}
