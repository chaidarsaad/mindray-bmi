<div>
    @if ($trainings->isNotEmpty())
        <section class="flat-spacing-6 pb_0">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title">Pelatihan USG Terbaru</span>
                <a href="{{ route('training.all') }}" class="tf-btn btn-line">
                    <p class="sub-title">
                        Lihat Semua Pelatihan<i class="icon icon-arrow1-top-left"></i>
                    </p>
                </a>
            </div>
            <div class="blog-grid-main">
                <div class="container">
                    <div class="row">
                        {{-- 1 --}}
                        @foreach ($trainings as $training)
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="blog-article-item">
                                    <div class="article-thumb">
                                        <a href="{{ route('detail.training', $training->slug) }}">
                                            <img src="{{ Storage::url($training->image) }}" alt="img-training" />

                                        </a>
                                    </div>
                                    <div class="article-content">
                                        <div class="article-title">
                                            <a href="{{ route('detail.training', $training->slug) }}"
                                                class="">{{ $training->judul }}</a>
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
