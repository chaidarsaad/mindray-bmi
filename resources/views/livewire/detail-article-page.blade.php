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

        .article-content img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
            display: block;
            /* margin: 1rem 0; */

            width: 100%;
            max-width: 720px;
        }

        .article-content img {
            margin-left: auto;
            margin-right: auto;
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
                                        src="{{ Storage::url($article->image) }}" alt=""
                                        style="width:100%; max-width: 720px; margin-left: auto; margin-right:auto; display: block;">
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
