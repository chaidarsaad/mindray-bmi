<div class="tf-slideshow slider-effect-fade position-relative">
    @if ($banners->isNotEmpty())

        <div class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false"
            data-space="0" data-loop="true" data-auto-play="false" data-delay="0" data-speed="1000">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ Storage::url($banner->image) }}" alt="fashion-slideshow">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="wrap-pagination">
            <div class="container">
                <div class="sw-dots sw-pagination-slider justify-content-center"></div>
            </div>
        </div>
    @endif
</div>
