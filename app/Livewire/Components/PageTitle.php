<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class PageTitle extends Component
{
    public $title;

    public function mount()
    {
        $routeName = Route::currentRouteName();

        $this->title = match ($routeName) {
            'payment.training.confirmation' => 'Konfirmasi Pembayaran Pelatihan',
            'payment.product.confirmation' => 'Konfirmasi Pembayaran Produk USG',
            'checkout.training' => 'Daftar Pelatihan',
            'detail.training.order' => 'Detail Pesanan Pelatihan',
            'detail.product.order' => 'Detail Pesanan Produk USG',
            'usg.all' => 'Semua Produk USG Mindray',
            'training.all' => 'Semua Pelatihan',
            'article.all' => 'Semua Artikel',
            'dashboard' => 'Dashboard',
            'detail.category' => 'Kategori',
            'dashboard.detail-account' => 'Detail Akun',
            'dashboard.pesanan.pelatihan' => 'Pesanan Pelatihan',
            'dashboard.pesanan.produk' => 'Pesanan Produk USG',
            default => 'Halaman Tidak Ditemukan',
        };
    }
    public function render()
    {
        return view('livewire.components.page-title');
    }
}
