<div>
    @if ($testimonials->isNotEmpty())
        <section class="flat-spacing-5 pt_0 flat-testimonial">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title">Testimoni</span>
                    <p class="sub-title">Dengarkan apa yang mereka katakan tentang kami</p>
                </div>
                <div class="wrap-carousel">
                    <div class="swiper tf-sw-testimonial" data-preview="3" data-tablet="2" data-mobile="1"
                        data-space-lg="30" data-space-md="15">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="testimonial-item style-column wow fadeInUp" data-wow-delay="0s">
                                        <div class="rating">
                                            @for ($i = 0; $i < $testimonial->rating; $i++)
                                                <i class="icon-start"></i>
                                            @endfor
                                        </div>
                                        <div class="heading">{{ $testimonial->review }}
                                        </div>
                                        @if (!empty($testimonial->subreview))
                                            <div class="text">
                                                “ {{ $testimonial->subreview }} ”
                                            </div>
                                        @endif

                                        <div class="author">
                                            <div class="name">{{ $testimonial->name }}</div>
                                            <div class="metas">{{ $testimonial->title ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-testimonial lg"><span
                            class="icon icon-arrow-left"></span>
                    </div>
                    <div class="nav-sw nav-prev-slider nav-prev-testimonial lg"><span
                            class="icon icon-arrow-right"></span>
                    </div>
                    <div class="sw-dots style-2 sw-pagination-testimonial justify-content-center"></div>
                </div>
            </div>
        </section>
    @endif
</div>
