@section('title')
    BMI | Beranda
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- Carousel -->
        <div class="tf-slideshow slider-effect-fade position-relative">
            <div class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false"
                data-space="0" data-loop="true" data-auto-play="false" data-delay="0" data-speed="1000">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ asset('assets/images/slider/slider1.png') }}" alt="fashion-slideshow" />
                            {{-- <div class="box-content">
                                <div class="container">
                                    <h1 class="fade-item fade-item-1">
                                        Glamorous<br />Glam
                                    </h1>
                                    <p class="fade-item fade-item-2">
                                        From casual to formal, we've got you covered
                                    </p>
                                    <a href="#"
                                        class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Detail</span><i
                                            class="icon icon-arrow-right"></i></a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ asset('assets/images/slider/slider1.png') }}" alt="fashion-slideshow" />
                            {{-- <div class="box-content">
                                <div class="container">
                                    <h1 class="fade-item fade-item-1">
                                        Simple <br class="md-hidden" />Style
                                    </h1>
                                    <p class="fade-item fade-item-2">
                                        From casual to formal, we've got you covered
                                    </p>
                                    <a href="#"
                                        class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop
                                            collection</span><i class="icon icon-arrow-right"></i></a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ asset('assets/images/slider/slider1.png') }}" alt="fashion-slideshow" />
                            {{-- <div class="box-content">
                                <div class="container">
                                    <h1 class="fade-item fade-item-1">Glamorous<br />Glam</h1>
                                    <p class="fade-item fade-item-2">
                                        From casual to formal, we've got you covered
                                    </p>
                                    <a href="#"
                                        class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop
                                            collection</span><i class="icon icon-arrow-right"></i></a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-pagination">
                <div class="container">
                    <div class="sw-dots sw-pagination-slider justify-content-center"></div>
                </div>
            </div>
        </div>
        <!-- /Carousel -->

        <!-- Categories -->
        <section class="flat-spacing-4 flat-categorie">
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
                                            <a href="{{ route('detail.category') }}" wire:navigate.ignore
                                                class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}" wire:navigate.ignore
                                                    class="tf-btn collection-title hover-icon fs-15"><span>Kategori
                                                        1</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ route('detail.category') }}" wire:navigate.ignore
                                                class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}" wire:navigate.ignore
                                                    class="tf-btn collection-title hover-icon fs-15"><span>Kategori
                                                        2</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ route('detail.category') }}" wire:navigate.ignore
                                                class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}" wire:navigate.ignore
                                                    class="tf-btn collection-title hover-icon fs-15"><span>Kategori
                                                        2</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ route('detail.category') }}" wire:navigate.ignore
                                                class="collection-image img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    src="{{ asset('assets/images/collections/kategori.png') }}"
                                                    alt="collection-img" />
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ route('detail.category') }}" wire:navigate.ignore
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
        </section>
        <!-- /Categories -->

        <!-- Produk -->
        <section class="flat-spacing-5 flat-seller pt_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Produk Mindray</span>
                    <a href="{{ route('usg.all') }}" wire:navigate.ignore class="tf-btn btn-line">
                        <p class="sub-title">
                            Lihat Semua Produk<i class="icon icon-arrow1-top-left"></i>
                        </p>
                    </a>
                </div>
                <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
                    <!-- card product 1 -->
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="product-img">
                                <img class="lazyload img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn absolute-2">
                                {{-- <a href="#shoppingCart" data-bs-toggle="modal" --}}
                                <a href="#" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            <!-- <span class="price">$10.00</span> -->
                        </div>
                    </div>
                    <!-- card product 1 -->
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="product-img">
                                <img class="lazyload img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn absolute-2">
                                {{-- <a href="#shoppingCart" data-bs-toggle="modal" --}}
                                <a href="#" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            <!-- <span class="price">$10.00</span> -->
                        </div>
                    </div>
                    <!-- card product 1 -->
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="product-img">
                                <img class="lazyload img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn absolute-2">
                                {{-- <a href="#shoppingCart" data-bs-toggle="modal" --}}
                                <a href="#" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            <!-- <span class="price">$10.00</span> -->
                        </div>
                    </div>
                    <!-- card product 1 -->
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="product-img">
                                <img class="lazyload img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="lazyload img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn absolute-2">
                                {{-- <a href="#shoppingCart" data-bs-toggle="modal" --}}
                                <a href="#" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="{{ route('detail.product') }}" wire:navigate.ignore class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            <!-- <span class="price">$10.00</span> -->
                        </div>
                    </div>
                </div>
                <div class="tf-pagination-wrap view-more-button text-center">
                    <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore">
                        <span class="text"> Tampilkan Lainnya </span>
                    </button>
                </div>
            </div>
        </section>
        <!-- /Produk -->

        <!-- Pelatihan -->
        <section class="flat-spacing-6 pb_0">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title">Pelatihan Terbaru</span>
                <a href="{{ route('training.all') }}" wire:navigate.ignore class="tf-btn btn-line">
                    <p class="sub-title">
                        Lihat Semua Pelatihan<i class="icon icon-arrow1-top-left"></i>
                    </p>
                </a>
            </div>
            <div class="blog-grid-main">
                <div class="container">
                    <div class="row">
                        {{-- 1 --}}
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('detail.training') }}" wire:navigate.ignore>
                                        <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-2.jpg') }}"
                                            src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.training') }}" wire:navigate.ignore
                                            class="">The next
                                            generation of leather
                                            alternatives</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 1 --}}
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('detail.training') }}" wire:navigate.ignore>
                                        <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-2.jpg') }}"
                                            src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.training') }}" wire:navigate.ignore
                                            class="">The next
                                            generation of leather
                                            alternatives</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 1 --}}
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('detail.training') }}" wire:navigate.ignore>
                                        <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-2.jpg') }}"
                                            src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.training') }}" wire:navigate.ignore
                                            class="">The next
                                            generation of leather
                                            alternatives</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Pelatihan -->

        <!-- Artikel -->
        <section class="flat-spacing-6 pb_0">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title">Artikel Terbaru</span>
                <a href="{{ route('article.all') }}" wire:navigate.ignore class="tf-btn btn-line">
                    <p class="sub-title">
                        Lihat Semua Artikel<i class="icon icon-arrow1-top-left"></i>
                    </p>
                </a>
            </div>
            <div class="blog-grid-main">
                <div class="container">
                    <div class="row">
                        {{-- 1 --}}
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('detail.article') }}" wire:navigate.ignore>
                                        <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-2.jpg') }}"
                                            src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.article') }}" wire:navigate.ignore
                                            class="">The next
                                            generation of
                                            leather
                                            alternatives</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 1 --}}
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('detail.article') }}" wire:navigate.ignore>
                                        <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-2.jpg') }}"
                                            src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.article') }}" wire:navigate.ignore
                                            class="">The next
                                            generation of
                                            leather
                                            alternatives</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 1 --}}
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('detail.article') }}" wire:navigate.ignore>
                                        <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-2.jpg') }}"
                                            src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.article') }}" wire:navigate.ignore
                                            class="">The next
                                            generation of
                                            leather
                                            alternatives</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Artikel -->

        <!-- Dokter Spesialis -->
        <section class="flat-spacing-1 pt_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Dokter Spesialis Kami</span>
                    <p class="sub-title">
                        Kami memiliki dokter spesialis yang profesional dibidangnya.
                    </p>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2"
                        data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                        data-pagination-md="1" data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            {{-- 1 --}}
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="title link text-center">Dr
                                            Rajes Punjabi</a>
                                        {{-- <span class="price">$10.00</span> --}}
                                        <p class="text-center">Spesialis Kandungan</p>
                                    </div>
                                </div>
                            </div>
                            {{-- 2 --}}
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="title link text-center">Dr
                                            Rajes Punjabi</a>
                                        {{-- <span class="price">$10.00</span> --}}
                                        <p class="text-center">Spesialis Kandungan</p>
                                    </div>
                                </div>
                            </div>
                            {{-- 2 --}}
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="title link text-center">Dr
                                            Rajes Punjabi</a>
                                        {{-- <span class="price">$10.00</span> --}}
                                        <p class="text-center">Spesialis Kandungan</p>
                                    </div>
                                </div>
                            </div>
                            {{-- 2 --}}
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                src="{{ asset('assets/images/doctors/doctors.png') }}"
                                                alt="image-product">
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product') }}" wire:navigate.ignore
                                            class="title link text-center">Dr
                                            Rajes Punjabi</a>
                                        {{-- <span class="price">$10.00</span> --}}
                                        <p class="text-center">Spesialis Kandungan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span
                            class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span
                            class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Dokter Spesialis -->

        <!-- Icon box -->
        <section class="flat-spacing-7 flat-iconbox wow fadeInUp" data-wow-delay="0s">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title">Kelebihan Belanja di Kami</span>
                    <!-- <p class="sub-title">Hear what they say about us</p> -->
                </div>
                <div class="wrap-carousel wrap-mobile">
                    <div class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                        <div class="swiper-wrapper wrap-iconbox">
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-shipping"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">Free Shipping</div>
                                        <p>Free shipping over order $120</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-payment fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">Bayar Ditempat / COD</div>
                                        <p>Cek Barang Dulu Baru Bayar</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-return fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">14 Day Returns</div>
                                        <p>Within 30 days for an exchange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-suport"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">Dukungan Servis</div>
                                        <p>Melayani Servis Alat USG</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Icon box -->

        <!-- Question -->
        <section class="flat-spacing-11">
            <div class="container">
                <div class="tf-accordion-wrap d-flex justify-content-between">
                    <div class="content">
                        <h5 class="mb_24">Pertanyaan</h5>
                        <div class="flat-accordion style-default has-btns-arrow mb_60">
                            <div class="flat-toggle active">
                                <div class="toggle-title active">
                                    Apakah pengiriman diluar jawa barat ada biaya tambahan?
                                </div>
                                <div class="toggle-content">
                                    <p>Ya, ada biaya tambahan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
