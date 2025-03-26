@section('title')
    BMI | Detail Pelatihan
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        {{-- page --}}
        <!-- blog-detail -->
        <div class="blog-detail">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-detail-main">
                            <div class="blog-detail-main-heading">
                                <div class="title">{{ $training->judul }}</div>
                                <div class="image">
                                    <img class="" data-src="{{ Storage::url($training->image) }}"
                                        src="{{ Storage::url($training->image) }}" alt="">
                                </div>
                            </div>
                            <div class="desc">
                                {!! $training->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="tf-height-observer w-100 d-flex align-items-center">
                    <div class="tf-sticky-atc-infos" style="width: 100%;">
                        <form class="" style="width: 100%;">
                            <div class="tf-sticky-atc-btns" style="width: 100%;">
                                <a href="#"
                                    class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn "><span>Tambah
                                        ke keranjang</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /blog-detail -->

        {{-- /page --}}

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
