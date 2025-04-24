<div>
    @if ($articles->isNotEmpty())
        <section class="flat-spacing-6 pb_0">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title">Artikel Terbaru</span>
                <a href="{{ route('article.all') }}" class="tf-btn btn-line">
                    <p class="sub-title">
                        Lihat Semua Artikel<i class="icon icon-arrow1-top-left"></i>
                    </p>
                </a>
            </div>
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
                                                alt="{{ $article->judul }}e" />
                                        </a>
                                    </div>
                                    <div class="article-content">
                                        <div class="article-title">
                                            <a style="text-align: center;"
                                                href="{{ route('detail.article', $article->slug) }}"
                                                class="">{{ $article->judul }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
