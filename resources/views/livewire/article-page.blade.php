@section('title')
    BMI | Artikel
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        <!-- Artikel -->
        <section class="flat-spacing-6 pb_0">
            <div class="blog-grid-main">
                <div class="container">
                    <div class="row">
                        {{-- 1 --}}
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('detail.article') }}">
                                        <img class="" data-src="{{ asset('assets/images/blog/wxp.webp') }}"
                                            src="{{ asset('assets/images/blog/wxp.webp') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.article') }}" class="">The
                                            next
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
                                    <a href="{{ route('detail.article') }}">
                                        <img class="" data-src="{{ asset('assets/images/blog/wxp.webp') }}"
                                            src="{{ asset('assets/images/blog/wxp.webp') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.article') }}" class="">The
                                            next
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
                                    <a href="{{ route('detail.article') }}">
                                        <img class="" data-src="{{ asset('assets/images/blog/wxp.webp') }}"
                                            src="{{ asset('assets/images/blog/wxp.webp') }}" alt="img-blog" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('detail.article') }}" class="">The
                                            next
                                            generation of
                                            leather
                                            alternatives</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="tf-pagination-wrap view-more-button text-center">
                    <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore">
                        <span class="text"> Tampilkan Lainnya </span>
                    </button>
                </div>
            </div>
        </section>
        <!-- /Artikel -->

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
