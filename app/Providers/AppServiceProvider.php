<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Article;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Expense;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Training;
use App\Models\TrainingOrder;
use App\Observers\AboutObserver;
use App\Observers\ArticleObserver;
use App\Observers\CarouselObserver;
use App\Observers\CategoryObserver;
use App\Observers\ExpenseObserver;
use App\Observers\PaymentMethodObserver;
use App\Observers\ProductObserver;
use App\Observers\TrainingObserver;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Category::observe(CategoryObserver::class);
        Carousel::observe(CarouselObserver::class);
        About::observe(AboutObserver::class);
        Product::observe(ProductObserver::class);
        Training::observe(TrainingObserver::class);
        Article::observe(ArticleObserver::class);
        PaymentMethod::observe(PaymentMethodObserver::class);
        Expense::observe(ExpenseObserver::class);
    }
}
