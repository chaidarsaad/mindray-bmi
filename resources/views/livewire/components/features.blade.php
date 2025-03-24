<div>
    @if ($features->isNotEmpty())
        <section class="flat-spacing-7 flat-iconbox wow fadeInUp" data-wow-delay="0s">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title" style="text-align: center;">Mengapa anda harus belanja di kami</span>
                    <!-- <p class="sub-title">Hear what they say about us</p> -->
                </div>
                <div class="wrap-carousel wrap-mobile">
                    <div class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                        <div class="swiper-wrapper wrap-iconbox">
                            @foreach ($features as $feature)
                                <div class="swiper-slide">
                                    <div class="tf-icon-box style-border-line text-center">
                                        <div class="icon">
                                            {!! $feature->logo !!}
                                        </div>
                                        <div class="content">
                                            <div class="title">{{ $feature->title }}</div>
                                            <p>{{ $feature->subtitle }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                </div>
            </div>
        </section>
    @endif
</div>
