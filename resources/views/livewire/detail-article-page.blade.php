@section('title')
    BMI | Detail Artikel
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
                                <div class="title">Something About This Style Of Jeans</div>
                                <div class="meta">by <span>admin</span> on <span>Oct 02</span></div>
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-detail-1.jpg') }}"
                                        src="{{ asset('assets/images/blog/blog-detail-1.jpg') }}" alt="">
                                </div>
                            </div>
                            <blockquote>
                                <div class="icon">
                                    <img src="{{ asset('assets/images/item/quote.svg') }}" alt="">
                                </div>
                                <div class="text">
                                    Typography is the work of typesetters, compositors, typographers, graphic designers,
                                    art directors, manga artists, comic book artists, graffiti artists, and now—anyone
                                    who arranges words, letters, numbers, and symbols for publication, display, or
                                    distribution—from clerical workers and newsletter writers to anyone self-publishing
                                    materials.
                                </div>
                            </blockquote>
                            <div class="grid-image">
                                <div>
                                    <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-detail-1.jpg') }}"
                                        src="{{ asset('assets/images/blog/blog-detail-1.jpg') }}" alt="">
                                </div>
                                <div>
                                    <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-detail-2.jpg') }}"
                                        src="{{ asset('assets/images/blog/blog-detail-2.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="desc">
                                Pellentesque dapibus hendrerit tortor. Nam ipsum risus, rutrum vitae, vestibulum eu,
                                molestie vel, lacus. Sed libero. Phasellus tempus. Etiam feugiat lorem non metus
                                Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna. Pellentesque
                                commodo eros a enim. Etiam sit amet orci eget eros faucibus tincidunt. Vestibulum purus
                                quam, scelerisque ut, mollis sed, nonummy id, metus.In hac habitasse platea dictumst.
                                Etiam ultricies nisi vel augue. Pellentesque egestas, neque sit amet convallis pulvinar,
                                justo nulla eleifend augue, ac auctor orci leo non est. Quisque rutrum. Duis leo. <br>
                                <br> <br>
                                Pellentesque dapibus hendrerit tortor. Nam ipsum risus, rutrum vitae, vestibulum eu,
                                molestie vel, lacus. Sed libero. Phasellus tempus. Etiam feugiat lorem non metus. Morbi
                                mattis ullamcorper velit. Donec sodales sagittis magna. Curabitur a felis in nunc
                                fringilla tristique. Quisque malesuada placerat nisl. Phasellus gravida semper nisi.
                                <br> <br> <br>
                                Curabitur blandit mollis lacus. Phasellus nec sem in justo pellentesque facilisis.
                                Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Fusce ac felis sit
                                amet ligula pharetra condimentum. Integer tincidunt. <br> <br> <br>
                                Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna. Pellentesque
                                commodo eros a enim. Etiam sit amet orci eget eros faucibus tincidunt. Vestibulum purus
                                quam, scelerisque ut, mollis sed, nonummy id, metus.In hac habitasse platea dictumst.
                                Etiam ultricies nisi vel augue. Pellentesque egestas, neque sit amet convallis pulvinar,
                                justo nulla eleifend augue, ac auctor orci leo non est. Quisque rutrum. Duis leo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /blog-detail -->

        <!-- Related Articles -->
        <section class="mb_30">
            <div class="container">
                <div class="flat-title">
                    <h5 class="">Related Articles</h5>
                </div>
                <div class="hover-sw-nav view-default hover-sw-5">
                    <div class="swiper tf-sw-recent" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30"
                        data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
                        data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" lazy="true">
                                <div class="blog-article-item">
                                    <div class="article-thumb radius-10">
                                        <a href="{{ route('detail.article') }}">
                                            <img class="lazyload" data-src="{{ asset('assets/images/blog/wxp.webp') }}"
                                                src="{{ asset('assets/images/blog/wxp.webp') }}" alt="img-blog">
                                        </a>
                                    </div>
                                    <div class="article-content">
                                        <div class="article-title">
                                            <a href="{{ route('detail.article') }}" class="">The
                                                next generation of leather
                                                alternatives</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="blog-article-item">
                                    <div class="article-thumb radius-10">
                                        <a href="{{ route('detail.article') }}">
                                            <img class="lazyload" data-src="{{ asset('assets/images/blog/wxp.webp') }}"
                                                src="{{ asset('assets/images/blog/wxp.webp') }}" alt="img-blog">
                                        </a>
                                    </div>
                                    <div class="article-content">
                                        <div class="article-title">
                                            <a href="{{ route('detail.article') }}" class="">The
                                                next generation of leather
                                                alternatives</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span
                            class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span
                            class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots d-flex style-2 sw-pagination-recent justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Related Articles -->

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
