<div class="col-lg-3">
    <ul class="my-account-nav">
        <li>
            <a href="{{ route('dashboard') }}" wire:navigate.ignore
                class="my-account-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('dashboard.pesanan') }}" wire:navigate.ignore
                class="my-account-nav-item {{ request()->routeIs('dashboard.pesanan') ? 'active' : '' }}">Pesanan</a>
        </li>
        <li>
            <a href="{{ route('dashboard.detail-account') }}" wire:navigate.ignore
                class="my-account-nav-item {{ request()->routeIs('dashboard.detail-account') ? 'active' : '' }}">Detail
                Akun</a>
        </li>
        @if (Auth::user()->roles->isNotEmpty())
            <li>
                <a href="{{ route('filament.admin.pages.dashboard') }}" wire:navigate.ignore
                    class="my-account-nav-item">Dashboard Admin</a>
            </li>
        @endif
        <li>
            <button wire:click="logout" class="my-account-nav-item">Keluar</button>
        </li>
    </ul>
</div>
