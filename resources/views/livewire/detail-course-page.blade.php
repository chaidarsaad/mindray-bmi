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
                                <div class="title">Something About This Style Of Jeans</div>
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('assets/images/blog/blog-detail-1.jpg') }}"
                                        src="{{ asset('assets/images/blog/blog-detail-1.jpg') }}" alt="">
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
