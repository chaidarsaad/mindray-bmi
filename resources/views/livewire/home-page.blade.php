@section('title')
    BMI | Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- Carousel -->
        @livewire('components.carousel')
        <!-- /Carousel -->

        <!-- Categories -->
        {{-- <section class="flat-spacing-4 flat-categorie">
            <div class="container-full">
                <div class="flat-title-v2">
                    <div class="box-sw-navigation">
                        <div class="nav-sw nav-next-slider nav-next-collection">
                            <span class="icon icon-arrow-left"></span>
                        </div>
                        <div class="nav-sw nav-prev-slider nav-prev-collection">
                            <span class="icon icon-arrow-right"></span>
                        </div>
                    </div>
                    <span class="text-3 fw-7 text-uppercase title wow fadeInUp" data-wow-delay="0s">Kategori Alat
                        USG</span>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile="2"
                            data-space-lg="30" data-space-md="30" data-space="15" data-loop="false"
                            data-auto-play="false">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ route('detail.category') }}" class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}"
                                                    class="tf-btn collection-title hover-icon fs-15"><span>Kategori
                                                        1</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ route('detail.category') }}" class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}"
                                                    class="tf-btn collection-title hover-icon fs-15"><span>Kategori
                                                        2</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ route('detail.category') }}" class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}"
                                                    class="tf-btn collection-title hover-icon fs-15"><span>Kategori
                                                        2</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ route('detail.category') }}"
                                                class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    src="{{ asset('assets/images/collections/kategori.webp') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}"
                                                    class="tf-btn collection-title hover-icon fs-15"><span>Kategori
                                                        2</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- /Categories -->

        <!-- Produk -->
        <section class="flat-spacing-5 flat-seller" style="margin-top: 40px">
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Berbagai Produk USG Mindray</span>
                    <a href="{{ route('usg.all') }}" class="tf-btn btn-line">
                        <p class="sub-title">
                            Lihat Semua Produk<i class="icon icon-arrow1-top-left"></i>
                        </p>
                    </a>
                </div>
                <div style="width:auto">
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="text-wrap: nowrap; font-size:larger">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pencitraan-tab" data-bs-toggle="tab"
                                data-bs-target="#pencitraan" type="button" role="tab" aria-controls="pencitraan"
                                aria-selected="true">Pencitraan Umum</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="wanita-tab" data-bs-toggle="tab" data-bs-target="#wanita"
                                type="button" role="tab" aria-controls="wanita" aria-selected="false">Kesehatan
                                Kaum Wanita</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kardiovaskular-tab" data-bs-toggle="tab"
                                data-bs-target="#kardiovaskular" type="button" role="tab"
                                aria-controls="kardiovaskular" aria-selected="false">Kardiovaskular</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pointofcare-tab" data-bs-toggle="tab"
                                data-bs-target="#pointofcare" type="button" role="tab" aria-controls="pointofcare"
                                aria-selected="false">Point of Care</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="primarycare-tab" data-bs-toggle="tab"
                                data-bs-target="#primarycare" type="button" role="tab" aria-controls="primarycare"
                                aria-selected="false">Primary Care</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent" style="margin-top: 10px">
                        <!-- Pencitraan Umum Tab -->
                        <div class="tab-pane fade show active" id="pencitraan" role="tabpanel"
                            aria-labelledby="pencitraan-tab">
                            <div class="grid-layout loadmore-item" data-grid="grid-4">
                                <!-- Card Produk Pencitraan Umum -->
                                <div class="card-product fl-item">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" class="title link">Mindray BeneHeart R3
                                            Electrocardiograph</a>
                                    </div>
                                </div>
                                <!-- Tambahkan produk lainnya sesuai kebutuhan -->
                            </div>
                        </div>

                        <!-- Kesehatan Kaum Wanita Tab -->
                        <div class="tab-pane fade" id="wanita" role="tabpanel" aria-labelledby="wanita-tab">
                            <div class="grid-layout loadmore-item" data-grid="grid-4">
                                <!-- Card Produk Kesehatan Kaum Wanita -->
                                <div class="card-product fl-item">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" class="title link">Mindray BeneHeart
                                            R3 Electrocardiograph</a>
                                    </div>
                                </div>
                                <!-- Tambahkan produk lainnya sesuai kebutuhan -->
                            </div>
                        </div>

                        <!-- Kardiovaskular Tab -->
                        <div class="tab-pane fade" id="kardiovaskular" role="tabpanel"
                            aria-labelledby="kardiovaskular-tab">
                            <div class="grid-layout loadmore-item" data-grid="grid-4">
                                <!-- Card Produk Kardiovaskular -->
                                <div class="card-product fl-item">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" class="title link">Mindray BeneHeart
                                            R3 Electrocardiograph</a>
                                    </div>
                                </div>
                                <!-- Tambahkan produk lainnya sesuai kebutuhan -->
                            </div>
                        </div>

                        <!-- Point of Care Tab -->
                        <div class="tab-pane fade" id="pointofcare" role="tabpanel"
                            aria-labelledby="pointofcare-tab">
                            <div class="grid-layout loadmore-item" data-grid="grid-4">
                                <!-- Card Produk Point of Care -->
                                <div class="card-product fl-item">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" class="title link">Mindray BeneHeart
                                            R3 Electrocardiograph</a>
                                    </div>
                                </div>
                                <!-- Tambahkan produk lainnya sesuai kebutuhan -->
                            </div>
                        </div>

                        <!-- Primary Care Tab -->
                        <div class="tab-pane fade" id="primarycare" role="tabpanel"
                            aria-labelledby="primarycare-tab">
                            <div class="grid-layout loadmore-item" data-grid="grid-4">
                                <!-- Card Produk Primary Care -->
                                <div class="card-product fl-item">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="image-product" />
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" class="title link">Mindray BeneHeart
                                            R3 Electrocardiograph</a>
                                    </div>
                                </div>
                                <!-- Tambahkan produk lainnya sesuai kebutuhan -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /Produk -->

        <!-- Pelatihan -->
        @livewire('components.training')
        <!-- /Pelatihan -->

        <!-- Artikel -->
        @livewire('components.article')
        <!-- /Artikel -->

        <!-- Testimonial -->
        @livewire('components.testimonials')
        <!-- /Testimonial -->

        <!-- Features -->
        @livewire('components.features')
        <!-- /Features -->

        <!-- Question -->
        @livewire('components.question')
        <!-- /Question -->

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

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let message = @json(session('notify-error'));

            if (message) {
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red",
                }).showToast();
            }
        });
    </script>
@endpush
