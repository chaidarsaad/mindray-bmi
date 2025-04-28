@push('meta-seo')
    <meta name="description"
        content="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC. Dapatkan informasi lengkap tentang produk dan pelatihan kami di sini.">
    <meta name="keywords"
        content="usg, mindray, pelatihan, abdomen, anc, alat kesehatan, usg mindray, pelatihan usg, alat usg, usg bandung, pelatihan anc dan abdomen, produk usg mindray">
    <meta name="author" content="USG Mindray">

    <meta property="og:title" content="Artikel">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="USG Mindray">
    <meta property="og:description" content="Semua Artikel">
    <meta property="og:image" content="{{ asset('assets/images/logo/logo USG MINDRAY BMI bulat.jpg') }}">
@endpush

@section('title')
    Semua Artikel | USG Mindray
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
        <div>
            @if ($articles->count())
                <section class="flat-spacing-6 pb_0 article-scroll">
                    <div class="blog-grid-main">
                        <div class="container">
                            <div class="row">
                                @foreach ($articles as $article)
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="blog-article-item">
                                            <div class="article-thumb">
                                                <a href="{{ route('detail.article', $article->slug) }}">
                                                    <img class="" data-src="{{ Storage::url($article->image) }}"
                                                        src="{{ Storage::url($article->image) }}"
                                                        alt="{{ $article->slug }}" />
                                                </a>
                                            </div>
                                            <div class="article-content">
                                                <div class="article-title">
                                                    <a href="{{ route('detail.article', $article->slug) }}"
                                                        class=""
                                                        style="text-align: center;">{{ $article->judul }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-0 d-flex justify-content-center">
                            {{ $articles->links('pagination::bootstrap-4') }}
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
        <!-- /Artikel -->

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

@push('scripts')
    <script>
        document.addEventListener('livewire:navigated', () => {
            const el = document.querySelector('.article-scroll');
            if (el) {
                setTimeout(() => {
                    el.scrollIntoView({
                        behavior: 'smooth'
                    });
                }, 50);
            }
        });
    </script>
@endpush
