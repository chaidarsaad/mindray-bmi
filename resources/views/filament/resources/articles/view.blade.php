@section('title')
    {{ $article->judul }} | USG Mindray
@endsection

@push('styles')
    <style>
        .article-content {
            word-break: normal;
            overflow-wrap: break-word;
            hyphens: auto;
            max-width: 100%;
            box-sizing: border-box;
        }

        .article-content img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
            display: block;
            width: 100%;
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Style untuk heading */
        .article-content h1 {
            font-size: 40px !important;
            font-weight: bold !important;
            line-height: 48px !important;
        }

        .article-content h2 {
            font-size: 32px !important;
            font-weight: bold !important;
            line-height: 40px !important;
        }

        .article-content h3 {
            font-size: 28px !important;
            font-weight: bold !important;
            line-height: 36px !important;
        }

        .article-content h4 {
            font-size: 24px !important;
            font-weight: bold !important;
            line-height: 32px !important;
        }

        .article-content h5 {
            font-size: 20px !important;
            font-weight: bold !important;
            line-height: 28px !important;
        }

        .article-content h6 {
            font-size: 18px !important;
            font-weight: bold !important;
            line-height: 24px !important;
        }

        .article-content h1 span,
        .article-content h2 span,
        .article-content h3 span,
        .article-content h4 span,
        .article-content h5 span,
        .article-content h6 span {
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            /* color: inherit !important; */
        }

        /* bullet */
        .article-content ul {
            list-style-type: disc !important;
            list-style-position: outside !important;
            padding-left: 1.5em !important;
            margin: 0 0 1em 0 !important;
            text-align: left !important;
        }

        .article-content li {
            list-style: disc !important;
            display: list-item !important;
            font-size: inherit !important;
            margin-bottom: 5px !important;
            line-height: 1.8em !important;
            vertical-align: baseline !important;
        }

        .share-buttons a:hover {
            opacity: 0.8;
            transform: scale(1.1);
            transition: 0.2s;
        }
    </style>
@endpush


<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

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
                                        @if ($article->user && $article->user->avatar)
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

                                <div class="share-buttons"
                                    style="margin: 20px 0; display: flex; gap: 15px; align-items: center; justify-content: center;">
                                    <span>Bagikan:</span>

                                    {{-- WhatsApp --}}
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->judul . "\n" . url()->current()) }}"
                                        target="_blank" rel="noopener" title="Bagikan ke WhatsApp"
                                        style="color: #25D366;">
                                        <i class="fab fa-whatsapp fa-lg"></i>
                                    </a>

                                    {{-- Facebook --}}
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank" rel="noopener" title="Bagikan ke Facebook"
                                        style="color: #3b5998;">
                                        <i class="fab fa-facebook fa-lg"></i>
                                    </a>

                                    {{-- Twitter --}}
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->judul . "\n" . url()->current()) }}"
                                        target="_blank" rel="noopener" title="Bagikan ke Twitter"
                                        style="color: #1DA1F2;">
                                        <i class="fab fa-twitter fa-lg"></i>
                                    </a>

                                    {{-- Telegram --}}
                                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->judul) }}"
                                        target="_blank" rel="noopener" title="Bagikan ke Telegram"
                                        style="color: #0088cc;">
                                        <i class="fab fa-telegram fa-lg"></i>
                                    </a>

                                    {{-- Copy Link --}}
                                    <a href="javascript:void(0);" onclick="copyArticleLink()" title="Salin tautan"
                                        style="color: #333;">
                                        <i class="fas fa-link fa-lg"></i>
                                    </a>
                                </div>


                                <div class="image">
                                    <img class="" data-src="{{ Storage::url($article->image) }}"
                                        src="{{ Storage::url($article->image) }}" alt="{{ $article->judul }}"
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

@push('scripts')
    <script>
        function copyArticleLink() {
            navigator.clipboard.writeText("{{ url()->current() }}")
                .then(() => alert("Tautan berhasil disalin!"))
                .catch(err => console.error("Gagal menyalin tautan:", err));
        }
    </script>
@endpush
