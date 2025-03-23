<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
    <div class="mb-canvas-content">
        <div class="mb-body">
            <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                <li class="nav-mb-item">
                    <a href="{{ route('home') }}" wire:navigate.ignore
                        class="collapsed mb-menu-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        aria-expanded="true">
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-mb-item">
                    <a href="{{ route('usg.all') }}" wire:navigate.ignore
                        class="collapsed mb-menu-link {{ request()->routeIs('usg.all') ? 'active' : '' }}"
                        aria-expanded="true">
                        <span>Produk USG</span>
                    </a>
                </li>
                <li class="nav-mb-item">
                    <a href="{{ route('training.all') }}" wire:navigate.ignore
                        class="collapsed mb-menu-link {{ request()->routeIs('training.all') ? 'active' : '' }}"
                        aria-expanded="true">
                        <span>Pelatihan</span>
                    </a>
                </li>
                <li class="nav-mb-item">
                    <a href="{{ route('article.all') }}" wire:navigate.ignore
                        class="collapsed mb-menu-link {{ request()->routeIs('article.all') ? 'active' : '' }}"
                        aria-expanded="true">
                        <span>Artikel</span>
                    </a>
                </li>
            </ul>

            <div class="mb-other-content">
                {{-- <div class="mb-notice">
                    <a href="#" class="text-need">Butuh Bantuan ?</a>
                </div> --}}

                <div class="footer-logo" style="margin-bottom: 10px; margin-top:30px;">
                    @if (!empty($about->logo))
                        <img src="{{ Storage::url($about->logo) }}" alt="" class="logo-bmi" />
                    @else
                        <img src="{{ asset('assets/images/logo/bmi.webp') }}" alt="Default Logo" class="logo-bmi" />
                    @endif
                </div>

                <ul class="mb-info">
                    <li>
                        @if (!empty($about->trusted))
                            <p>{{ $about->trusted }}</p>
                        @endif
                    </li>
                    <li>
                        @if (!empty($about->address))
                            <p>Alamat: <a href="">
                                    {{ $about->address }}
                                </a>
                            </p>
                        @endif
                    </li>
                    <li>
                        @if (!empty($about->email))
                            <p>Email: <a href="mailto:{{ $about->email }}">{{ $about->email }}</a></p>
                        @endif
                    </li>
                    <li>
                        @if (!empty($about->phone_number))
                            <p>No HP: <a href="tel:+62{{ $about->phone_number }}">+62{{ $about->phone_number }}</a>
                            </p>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="mb-bottom">
            @auth
                <a href="{{ route('dashboard') }}" wire:navigate.ignore class="site-nav-icon"><i
                        class="icon icon-account"></i>Profil</a>
            @else
                <a href="{{ route('login') }}" wire:navigate.ignore class="site-nav-icon"><i
                        class="icon icon-account"></i>Masuk</a>
            @endauth
            {{-- @if (Auth::user()->roles->isNotEmpty())
                <a href="{{ route('filament.admin.pages.dashboard') }}" wire:navigate.ignore class="site-nav-icon"><i
                        class="icon icon-home"></i>Admin</a>
            @endif --}}
        </div>
    </div>
</div>
