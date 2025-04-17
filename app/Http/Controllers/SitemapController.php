<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Training;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $articles  = Article::latest()->get();
        $products  = Product::latest()->get();
        $trainings = Training::latest()->get();

        return response()->view('sitemap', [
            'articles'  => $articles,
            'products'  => $products,
            'trainings' => $trainings,
        ])->header('Content-Type', 'text/xml');
    }
}
