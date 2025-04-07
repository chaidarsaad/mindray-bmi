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
            'checkout.training' => 'Daftar Pelatihan',
            'detail.training.order' => 'Detail Pesanan Pelatihan',
            'usg.all' => 'Semua Produk USG Mindray',
            'training.all' => 'Semua Pelatihan',
            'article.all' => 'Semua Artikel',
            'checkout' => 'Proses Pesanan',
            'dashboard' => 'Dashboard',
            'detail.category' => 'Kategori',
            'dashboard.detail-account' => 'Detail Akun',
            'dashboard.pesanan' => 'Pesanan',
            'cart' => 'Keranjang Belanja',
            default => 'Halaman Tidak Diketahui',
        };
    }
    public function render()
    {
        return view('livewire.components.page-title');
    }
}
