@section('title')
    BMI | Detail Produk
@endsection

@push('styles')
    <style>
        /* Menambahkan aturan untuk konten yang lebih responsif */
        .article-content {
            word-wrap: break-word;
            /* Memecah kata yang terlalu panjang */
            overflow-wrap: break-word;
            /* Menambahkan kompatibilitas browser */
            word-break: break-all;
            /* Memastikan kata panjang dipecah jika perlu */
            max-width: 100%;
            /* Membatasi lebar konten */
            box-sizing: border-box;
            /* Pastikan padding dan margin tidak menambah lebar elemen */
        }
    </style>
@endpush

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        {{-- page --}}
        <!-- breadcrumb -->
        <div class="tf-breadcrumb">
            <div class="container">
                <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                    <div class="tf-breadcrumb-list">
                        <a href="{{ route('home') }}" class="text">Beranda</a>
                        <i class="icon icon-arrow-right"></i>
                        <a href="#" class="text">{{ $product->category->name }}</a>
                        <i class="icon icon-arrow-right"></i>
                        <span class="text">{{ $product->subname }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- default -->
        <section class="flat-spacing-4 pt_0">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tf-product-media-wrap sticky-top">
                                <div class="thumbs-slider">
                                    <div class="swiper tf-product-media-thumbs other-image-zoom"
                                        data-direction="vertical">
                                        <div class="swiper-wrapper stagger-wrap">
                                            @foreach ($product->images as $image)
                                                <div class="swiper-slide stagger-item">
                                                    <div class="item">
                                                        <img class="" data-src="{{ Storage::url($image) }}"
                                                            src="{{ Storage::url($image) }}" alt="img-compare">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="swiper tf-product-media-main" id="gallery-swiper-started">
                                        <div class="swiper-wrapper">
                                            @foreach ($product->images as $image)
                                                <div class="swiper-slide">
                                                    <a href="{{ Storage::url($image) }}" target="_blank" class="item"
                                                        data-pswp-width="770px" data-pswp-height="1075px">
                                                        <img class="tf-image-zoom "
                                                            data-zoom="{{ Storage::url($image) }}"
                                                            data-src="{{ Storage::url($image) }}"
                                                            src="{{ Storage::url($image) }}" alt="">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                        <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tf-product-info-wrap position-relative">
                                <div class="tf-zoom-main"></div>
                                <div class="tf-product-info-list other-image-zoom">
                                    <div class="tf-product-info-title">
                                        <h5>{{ $product->subname }}</h5>
                                    </div>


                                    {{-- <div class="tf-product-info-quantity">
                                        <div class="quantity-title fw-6">Jumlah</div>
                                        <div class="wg-quantity">
                                            <span class="btn-quantity minus-btn">-</span>
                                            <input type="text" name="number" value="1">
                                            <span class="btn-quantity plus-btn">+</span>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tf-sticky-btn-atc">
                <div class="container">
                    <div class="tf-height-observer w-100 d-flex align-items-center">
                        <div class="tf-sticky-atc-product d-flex align-items-center">
                            <div class="tf-sticky-atc-img">
                                <img class="ed" data-src="{{ Storage::url($image) }}" alt=""
                                    src="{{ Storage::url($image) }}">
                            </div>
                            <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">{{ $product->subname }}</div>
                        </div>
                        <div class="tf-sticky-atc-infos">
                            <form class="">
                                <div class="tf-sticky-atc-btns">
                                    {{-- <div class="tf-product-info-quantity">
                                        <div class="wg-quantity">
                                            <span class="btn-quantity minus-btn">-</span>
                                            <input type="text" name="number" value="1">
                                            <span class="btn-quantity plus-btn">+</span>
                                        </div>
                                    </div> --}}
                                    <a href="#"
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn "><span>Pesan</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /default -->

        <!-- tabs -->
        <section class="flat-spacing-17 pt_0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-has-border">
                            <ul class="widget-menu-tab">
                                <!-- Tab untuk Deskripsi Tambahan Produk -->
                                @foreach ($productDescriptions as $index => $productDescription)
                                    <li class="item-title {{ $index === 0 ? 'active' : '' }}"
                                        data-tab="description_{{ $index }}">
                                        <span class="inner">{{ $productDescription->judul_deskripsi }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="widget-content-tab">
                                <!-- Konten untuk Setiap Deskripsi Produk -->
                                @foreach ($productDescriptions as $index => $productDescription)
                                    <div class="widget-content-inner {{ $index === 0 ? 'active' : '' }}"
                                        id="description_{{ $index }}">
                                        <div class="article-content">
                                            {!! $productDescription->description !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /tabs -->

        <!-- product -->
        @if ($otherProducts->count() > 0)
            <section class="flat-spacing-1 pt_0">
                <div class="container">
                    <div class="flat-title">
                        <span class="title">Alat USG Lainnya</span>
                    </div>
                    <div class="hover-sw-nav hover-sw-2">
                        <div class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2"
                            data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                            data-pagination-md="1" data-pagination-lg="1">
                            <div class="swiper-wrapper">
                                {{-- 1 --}}
                                @foreach ($otherProducts as $item)
                                    <div class="swiper-slide" lazy="true">
                                        <div class="card-product">
                                            <div class="card-product-wrapper">
                                                <a href="{{ route('detail.product', $item->slug) }}"
                                                    class="product-img">
                                                    <img class=" img-product"
                                                        data-src="{{ Storage::url($item->images[0]) }}"
                                                        src="{{ Storage::url($item->images[0]) }}"
                                                        alt="image-product">
                                                    <img class=" img-hover"
                                                        data-src="{{ Storage::url($item->images[0]) }}"
                                                        src="{{ Storage::url($item->images[0]) }}"
                                                        alt="image-product">
                                                </a>
                                            </div>
                                            <div class="card-product-info">
                                                <a href="{{ route('detail.product', $item->slug) }}"
                                                    class="title link">{{ $item->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
        @endif
        <!-- /product -->

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

@push('scripts')
    <script>
        // Menambahkan JavaScript untuk mengaktifkan tab yang benar
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.widget-menu-tab .item-title');
            const contentTabs = document.querySelectorAll('.widget-content-tab .widget-content-inner');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Menonaktifkan semua tab dan konten
                    tabs.forEach(t => t.classList.remove('active'));
                    contentTabs.forEach(content => content.classList.remove('active'));

                    // Menambahkan active pada tab dan konten yang dipilih
                    const tabId = tab.getAttribute('data-tab');
                    tab.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });
    </script>
@endpush
