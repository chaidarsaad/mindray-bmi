@section('title')
    BMI | Akun Saya
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        {{-- my-account --}}
        <section class="flat-spacing-11">
            <div class="container">
                <div class="row">
                    @livewire('components.sidebar-dashboard')
                    <div class="col-lg-9">
                        <div class="my-account-content account-dashboard">
                            <div class="mb_60">
                                <h5 class="fw-5 mb_20">Halo {{ Auth::user()->name }}</h5>
                                <p>
                                    Dari dasboard akun Anda, Anda dapat melihat
                                    <a class="text_primary" wire:navigate.ignore
                                        href="{{ route('dashboard.pesanan') }}">pesanan terbaru</a>, mengubah
                                    {{-- <a class="text_primary" wire:navigate.ignore
                                        href="">alamat</a>, dan --}}
                                    <a class="text_primary" wire:navigate.ignore
                                        href="{{ route('dashboard.detail-account') }}">
                                        password dan detail
                                        akun</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /my-account --}}

        <!-- Footer -->
        @livewire('components.footer')
        <!-- /Footer -->
    </div>

    <!-- whatsapp -->
    @livewire('components.whatsapp')
    <!-- /whatsapp -->

    <!-- mobile menu -->
    @livewire('components.mobile-menu')
    <!-- /mobile menu -->

    <!-- shoppingCart -->
    @livewire('components.sidebar-shopping-cart')
    <!-- /shoppingCart -->
</div>
