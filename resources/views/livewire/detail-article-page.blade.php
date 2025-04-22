@push('meta-seo')
    <meta name="description"
        content="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC. Dapatkan informasi lengkap tentang produk dan pelatihan kami di sini.">
    <meta name="keywords"
        content="usg, mindray, pelatihan, abdomen, anc, alat kesehatan, usg mindray, pelatihan usg, alat usg, usg bandung, pelatihan anc dan abdomen, produk usg mindray">
    <meta name="author" content="USG Mindray">

    <meta property="og:type" content="Artikel">
    <meta property="og:title" content="Artikel {{ $article->judul }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="USG Mindray">
    <meta property="og:description" content="Artikel {{ Str::limit(strip_tags($article->content), 150, '...') }}">
    <meta property="og:image" content="{{ asset('assets/images/logo/logo USG MINDRAY BMI bulat.jpg') }}">
@endpush

@section('title')
    {{ $article->judul }} | USG Mindray
@endsection

@push('styles')
    <style>
        /* Menambahkan aturan untuk konten yang lebih responsif */
        .article-content {
            /* Kata tidak dipotong sembarangan */
            word-break: normal;
            overflow-wrap: break-word;
            hyphens: auto;

            /* Tata letak tetap rapi */
            max-width: 100%;
            box-sizing: border-box;
        }

        }
    </style>
@endpush

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
                                <div class="title" style="margin-bottom: 5px;">{{ $article->judul }}</div>
                                <div class="title">{{ $article->sub_judul }}</div>
                                <div class="meta" style="margin-bottom: 10px;">
                                    <div class="author">
                                        @if ($article->user->avatar)
                                            <img src="{{ Storage::url($article->user->avatar) }}"
                                                alt="{{ $article->user->name }}"
                                                style="width: 60px; height: 60px; border-radius: 50%; margin-right: 10px;">
                                        @endif
                                        ditulis oleh <span>{{ $article->user->name ?? 'admin' }}</span>
                                    </div>
                                </div>

                                <div class="meta">
                                    {{ $article->created_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </div>
                                <div class="image">
                                    <img class="" data-src="{{ Storage::url($article->image) }}"
                                        src="{{ Storage::url($article->image) }}" alt="">
                                </div>
                            </div>
                            <div class="desc article-content">
                                {!! $article->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /blog-detail -->

        <!-- Related Articles -->
        {{-- @if ($otherArticle->isNotEmpty())
            <section class="mb_30">
                <div class="container">
                    <div class="flat-title">
                        <h5 class="">Related Articles</h5>
                    </div>
                    <div class="hover-sw-nav view-default hover-sw-5">
                        <div class="swiper tf-sw-recent" data-preview="3" data-tablet="2" data-mobile="1"
                            data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                            data-pagination-md="1" data-pagination-lg="1">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" lazy="true">
                                    <div class="blog-article-item">
                                        <div class="article-thumb radius-10">
                                            <a href="{{ route('detail.article') }}">
                                                <img class=""
                                                    data-src="{{ asset('assets/images/blog/wxp.webp') }}"
                                                    src="{{ asset('assets/images/blog/wxp.webp') }}" alt="img-blog">
                                            </a>
                                        </div>
                                        <div class="article-content">
                                            <div class="article-title">
                                                <a style="text-align: center;" href="{{ route('detail.article') }}"
                                                    class="">The
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
                                                <img class=""
                                                    data-src="{{ asset('assets/images/blog/wxp.webp') }}"
                                                    src="{{ asset('assets/images/blog/wxp.webp') }}" alt="img-blog">
                                            </a>
                                        </div>
                                        <div class="article-content">
                                            <div class="article-title">
                                                <a style="text-align: center;" href="{{ route('detail.article') }}"
                                                    class="">The
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
        @endif --}}
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
</div>
