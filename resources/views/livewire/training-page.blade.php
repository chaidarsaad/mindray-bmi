@section('title')
    Semua Pelatihan | USG Mindray
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        <!-- Pelatihan -->
        <div>
            @if ($trainings->isNotEmpty())
                <section class="flat-spacing-6 pb_0">
                    <div class="blog-grid-main">
                        <div class="container">
                            <div class="row">
                                @foreach ($trainings as $training)
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="blog-article-item">
                                            <div class="article-thumb">
                                                <a href="{{ route('detail.training', $training->slug) }}">
                                                    <img class="" data-src="{{ Storage::url($training->image) }}"
                                                        src="{{ Storage::url($training->image) }}" alt="img-blog" />
                                                </a>
                                            </div>
                                            <div class="article-content">
                                                <div class="article-title">
                                                    <a style="text-align: center;"
                                                        href="{{ route('detail.training', $training->slug) }}"
                                                        class="text-center">{{ $training->judul }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                        {{-- <div class="tf-pagination-wrap view-more-button text-center">
                            <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore">
                                <span class="text"> Tampilkan Lainnya </span>
                            </button>
                        </div> --}}
                    </div>
                </section>
            @endif
        </div>
        <!-- /Pelatihan -->

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
