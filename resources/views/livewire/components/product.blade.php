@push('styles')
    <style>
        /* Instruksi hanya tampil pada perangkat dengan lebar layar 767px atau lebih kecil */
        @media (max-width: 767px) {
            .scroll-hint {
                display: block;
            }
        }

        /* Instruksi tidak tampil pada layar yang lebih besar dari 767px */
        @media (min-width: 768px) {
            .scroll-hint {
                display: none;
            }
        }
    </style>
@endpush

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
                        data-bs-target="#kardiovaskular" type="button" role="tab" aria-controls="kardiovaskular"
                        aria-selected="false">Kardiovaskular</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pointofcare-tab" data-bs-toggle="tab" data-bs-target="#pointofcare"
                        type="button" role="tab" aria-controls="pointofcare" aria-selected="false">Point of
                        Care</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="primarycare-tab" data-bs-toggle="tab" data-bs-target="#primarycare"
                        type="button" role="tab" aria-controls="primarycare" aria-selected="false">Primary
                        Care</button>
                </li>
            </ul>

            <div class="scroll-hint" style="text-align: center; margin-top: 10px; color: #555; font-size: 14px;">
                <p>Geser untuk melihat lebih banyak kategori</p>
            </div>

            <div class="tab-content" id="myTabContent" style="margin-top: 10px">
                <!-- Pencitraan Umum Tab -->
                <div class="tab-pane fade show active" id="pencitraan" role="tabpanel" aria-labelledby="pencitraan-tab">
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
                <div class="tab-pane fade" id="kardiovaskular" role="tabpanel" aria-labelledby="kardiovaskular-tab">
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
                <div class="tab-pane fade" id="pointofcare" role="tabpanel" aria-labelledby="pointofcare-tab">
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
                <div class="tab-pane fade" id="primarycare" role="tabpanel" aria-labelledby="primarycare-tab">
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
