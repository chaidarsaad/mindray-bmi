<?php

use App\Http\Controllers\SitemapController;
use App\Livewire\AccountDetailPage;
use App\Livewire\ArticlePage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\CheckoutTrainingPage;
use App\Livewire\DetailArticlePage;
use App\Livewire\DetailCategoryPage;
use App\Livewire\DetailCoursePage;
use App\Livewire\DetailOrderTrainingPage;
use App\Livewire\DetailProductOrderPage;
use App\Livewire\DetailProductPage;
use App\Livewire\HomePage;
use App\Livewire\MyAccountPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\MyProductOrderPage;
use App\Livewire\ProductPaymentPage;
use App\Livewire\TrainingPage;
use App\Livewire\TrainingPaymentPage;
use App\Livewire\UsgPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/produk/{slug}', DetailProductPage::class)->name('detail.product');
Route::get('/artikel/{slug}', DetailArticlePage::class)->name('detail.article');
Route::get('/detail-pelatihan/{slug}', DetailCoursePage::class)->name('detail.training');
Route::get('/semua-produk', UsgPage::class)->name('usg.all');
Route::get('/semua-pelatihan', TrainingPage::class)->name('training.all');
Route::get('/semua-artikel', ArticlePage::class)->name('article.all');

Route::middleware(['guest'])->group(function () {
    Route::get('/masuk', LoginPage::class)->name('login');
    Route::get('/daftar', RegisterPage::class)->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', MyAccountPage::class)->name('dashboard');
    Route::get('/akun-saya', AccountDetailPage::class)->name('dashboard.detail-account');

    Route::get('/pesanan-produk-usg', MyProductOrderPage::class)->name('dashboard.pesanan.produk');
    Route::get('/detail-pesanan-produk-usg/{order:order_number}', DetailProductOrderPage::class)->name('detail.product.order');

    Route::get('/pesanan-pelatihan', MyOrdersPage::class)->name('dashboard.pesanan.pelatihan');
    Route::get('/detail-pesanan-pelatihan/{order:order_number}', DetailOrderTrainingPage::class)->name('detail.training.order');
});


Route::middleware(['auth', 'prevent-if-paid'])->group(function () {
    Route::get('/konfirmasi-pembayaran-pelatihan/{order:order_number}', TrainingPaymentPage::class)
        ->name('payment.training.confirmation');
    Route::get('/konfirmasi-pembayaran-produk-usg/{order:order_number}', ProductPaymentPage::class)
        ->name('payment.product.confirmation');
});



Route::middleware(['auth', 'checkTrainingEndDate'])->group(function () {
    Route::get('/daftar-pelatihan/{slug}', CheckoutTrainingPage::class)->name('checkout.training');
});

Route::get('/admin/articles/{article}/preview', [\App\Http\Controllers\Admin\ArticlePreviewController::class, 'show'])
    ->middleware('auth')
    ->name('admin.articles.preview');

Route::middleware('throttle:10,1')->get('/check-session', function () {
    return response()->json(['active' => auth()->check() || session()->has('_token')]);
});

Route::middleware(['web', 'throttle:10,1'])->get('/refresh-csrf', function () {
    if (!request()->ajax()) {
        abort(403, 'Forbidden');
    }

    return response()->json([
        'active' => auth()->check(),
        'csrf' => csrf_token()
    ]);
});



Route::get('/sitemap.xml', [SitemapController::class, 'index']);
