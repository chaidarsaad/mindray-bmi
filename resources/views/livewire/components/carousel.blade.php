@push('styles')
    <style>
        .tf-slideshow .swiper-slide .wrap-slider a {
            display: inline-block;
            width: 100%;
        }

        .tf-slideshow .swiper-slide .wrap-slider img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>
@endpush

<div class="tf-slideshow slider-effect-fade position-relative">
    @if ($banners->isNotEmpty())

        <div class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false"
            data-space="0" data-auto-play="true">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <a href="{{ $banner->url ?? '#' }}">
                                <img src="{{ Storage::url($banner->image) }}" alt="fashion-slideshow">
                            </a>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.tf-sw-slideshow', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 1000,
                pagination: {
                    el: '.sw-pagination-slider',
                    clickable: true,
                },
            });
        });
    </script>
@endpush
