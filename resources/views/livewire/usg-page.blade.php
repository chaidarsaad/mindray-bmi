@push('meta-seo')
    <meta name="description"
        content="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC. Dapatkan informasi lengkap tentang produk dan pelatihan kami di sini.">
    <meta name="keywords"
        content="usg, mindray, pelatihan, abdomen, anc, alat kesehatan, usg mindray, pelatihan usg, alat usg, usg bandung, pelatihan anc dan abdomen, produk usg mindray">
    <meta name="author" content="USG Mindray">

    <meta property="og:title" content="Produk USG Mindray">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="USG Mindray">
    <meta property="og:description" content="Semua Produk USG Mindray">
    <meta property="og:image" content="{{ asset('assets/images/logo/logo USG MINDRAY BMI bulat.jpg') }}">
@endpush

@section('title')
    Semua Produk USG Mindray | USG Mindray
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
        <div>
            @if ($products->isNotEmpty())
                <section class="flat-spacing-2">
                    <div class="container">

                        <div class="grid-layout wrapper-shop" data-grid="grid-4">
                            @foreach ($products as $product)
                                <div class="card-product">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('detail.product', $product->slug) }}" class="product-img">
                                            <img class="img-product" data-src="{{ Storage::url($product->images[0]) }}"
                                                src="{{ Storage::url($product->images[0]) }}" alt="image-product" />
                                            <img class="img-hover" data-src="{{ Storage::url($product->images[0]) }}"
                                                src="{{ Storage::url($product->images[0]) }}" alt="image-product" />
                                        </a>
                                        {{-- <div class="list-product-btn">
                                            <a href="#quick_add" data-bs-toggle="modal"
                                                class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-bag"></span>
                                                <span class="tooltip">+ Keranjang</span>
                                            </a>
                                        </div> --}}
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('detail.product', $product->slug) }}"
                                            class="title link text-center">{{ $product->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- pagination -->
                        {{-- <ul class="tf-pagination-wrap tf-pagination-list">
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
                    </ul> --}}
                        {{-- <div class="tf-pagination-wrap view-more-button text-center">
                        <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore">
                            <span class="text"> Tampilkan Lainnya </span>
                        </button>
                    </div> --}}
                    </div>
                </section>
            @endif
        </div>
        {{-- /page --}}

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
</div>
