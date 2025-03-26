@section('title')
    BMI | Detail Kategori
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        {{-- page --}}
        <section class="flat-spacing-2">
            <div class="container">

                <div class="grid-layout wrapper-shop" data-grid="grid-4">
                    <!-- card product 1 -->
                    <div class="card-product">
                        <div class="card-product-wrapper">
                            <a href="#" class="product-img">
                                <img class="img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn">
                                <a href="#quick_add" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="#" class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            {{-- <span class="price">$16.95</span> --}}
                        </div>
                    </div>
                    <!-- card product 1 -->
                    <div class="card-product">
                        <div class="card-product-wrapper">
                            <a href="#" class="product-img">
                                <img class="img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn">
                                <a href="#quick_add" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="#" class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            {{-- <span class="price">$16.95</span> --}}
                        </div>
                    </div>
                    <!-- card product 1 -->
                    <div class="card-product">
                        <div class="card-product-wrapper">
                            <a href="#" class="product-img">
                                <img class="img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn">
                                <a href="#quick_add" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="#" class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            {{-- <span class="price">$16.95</span> --}}
                        </div>
                    </div>
                    <!-- card product 1 -->
                    <div class="card-product">
                        <div class="card-product-wrapper">
                            <a href="#" class="product-img">
                                <img class="img-product"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                                <img class="img-hover"
                                    data-src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                    alt="image-product" />
                            </a>
                            <div class="list-product-btn">
                                <a href="#quick_add" data-bs-toggle="modal"
                                    class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">+ Keranjang</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="#" class="title link">Mindray
                                BeneHeart R3 Electrocardiograph</a>
                            {{-- <span class="price">$16.95</span> --}}
                        </div>
                    </div>
                </div>
                <!-- pagination -->
                <ul class="tf-pagination-wrap tf-pagination-list">
                    <li class="active">
                        <a href="#" class="pagination-link">1</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">2</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">3</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">4</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">
                            <span class="icon icon-arrow-right"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
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
