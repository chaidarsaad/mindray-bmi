<div class="col-lg-3">
    <ul class="my-account-nav">
        <li>
            <a href="{{ route('dashboard') }}"
                class="my-account-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('dashboard.pesanan.produk') }}"
                class="my-account-nav-item {{ request()->routeIs('dashboard.pesanan.produk') ? 'active' : '' }}">Pesanan
                Produk USG</a>
        </li>
        <li>
            <a href="{{ route('dashboard.pesanan.pelatihan') }}"
                class="my-account-nav-item {{ request()->routeIs('dashboard.pesanan.pelatihan') ? 'active' : '' }}">Pesanan
                Pelatihan</a>
        </li>
        <li>
            <a href="{{ route('dashboard.detail-account') }}"
                class="my-account-nav-item {{ request()->routeIs('dashboard.detail-account') ? 'active' : '' }}">Detail
                Akun</a>
        </li>
        @if (Auth::check() && Auth::user()->roles->isNotEmpty())
            <a href="{{ route('filament.admin.pages.dashboard') }}" class="my-account-nav-item"
                class="site-nav-icon">Akses CMS
            </a>
        @endif

        <li>
            <button wire:click="logout" class="my-account-nav-item">Keluar</button>
        </li>
    </ul>
</div>
