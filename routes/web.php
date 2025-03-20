<?php

use App\Livewire\AccountDetailPage;
use App\Livewire\ArticlePage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\DetailArticlePage;
use App\Livewire\DetailCategoryPage;
use App\Livewire\DetailCoursePage;
use App\Livewire\DetailProductPage;
use App\Livewire\HomePage;
use App\Livewire\MyAccountPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\TrainingPage;
use App\Livewire\UsgPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
// todo kategori /slug
Route::get('/detail-kategori', DetailCategoryPage::class)->name('detail.category');
// todo product /slug
Route::get('/detail-produk', DetailProductPage::class)->name('detail.product');
// todo article /slug
Route::get('/detail-artikel', DetailArticlePage::class)->name('detail.article');
// todo course /slug
Route::get('/detail-pelatihan', DetailCoursePage::class)->name('detail.training');
// todo usg /slug
Route::get('/semua-produk', UsgPage::class)->name('usg.all');
// todo training /slug
Route::get('/semua-pelatihan', TrainingPage::class)->name('training.all');
// todo article /slug
Route::get('/semua-artikel', ArticlePage::class)->name('article.all');

Route::middleware(['guest'])->group(function () {
    Route::get('/masuk', LoginPage::class)->name('login');
    Route::get('/daftar', RegisterPage::class)->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', CartPage::class)->name('cart');
    Route::get('/dashboard', MyAccountPage::class)->name('dashboard');
    Route::get('/pesanan-saya', MyOrdersPage::class)->name('dashboard.pesanan');
    Route::get('/akun-saya', AccountDetailPage::class)->name('dashboard.detail-account');
    Route::get('/proses-pesanan', CheckoutPage::class)->name('checkout');
});
