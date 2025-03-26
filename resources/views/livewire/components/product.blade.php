@push('styles')
    <style>
        /* Instruksi hanya tampil pada perangkat dengan lebar layar 767px atau lebih kecil */
        @media (max-width: 767px) {
            .scroll-hint {
                display: block;
            }
        }

        /* Instruksi tidak tampil pada layar yang lebih besar dari 767px */
        @media (min-width: 768px) {
            .scroll-hint {
                display: none;
            }
        }
    </style>
@endpush

<div>
    @if ($categories->isNotEmpty())
        <section class="flat-spacing-5 flat-seller" style="margin-top: 40px">
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Berbagai Produk USG Mindray</span>
                    <a href="{{ route('usg.all') }}" class="tf-btn btn-line">
                        <p class="sub-title">
                            Lihat Semua Produk<i class="icon icon-arrow1-top-left"></i>
                        </p>
                    </a>
                </div>
                <div style="width:auto">
                    <div class="scroll-hint"
                        style="text-align: center; margin-top: 10px; margin-bottom: 10px; color: #555; font-size: 14px;">
                        <p>Geser kesamping kategori dibawah ini untuk melihat kategori lainnya</p>
                    </div>
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="text-wrap: nowrap; font-size: larger">
                        @foreach ($categories as $index => $category)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                    id="{{ $category->slug }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#{{ $category->slug }}" type="button" role="tab"
                                    aria-controls="{{ $category->slug }}"
                                    aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                    {{ $category->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="myTabContent" style="margin-top: 10px">
                        @foreach ($categories as $index => $category)
                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="{{ $category->slug }}"
                                role="tabpanel" aria-labelledby="{{ $category->slug }}-tab">

                                <div class="grid-layout loadmore-item" data-grid="grid-4">
                                    @forelse ($category->products as $product)
                                        <div class="card-product fl-item">
                                            <div class="card-product-wrapper">
                                                <a href="{{ route('detail.product', $product->slug) }}"
                                                    class="product-img">
                                                    <img class="lazyload img-product"
                                                        data-src="{{ Storage::url($product->images[0]) }}"
                                                        src="{{ Storage::url($product->images[0]) }}"
                                                        alt="{{ $product->name }}" />
                                                    <img class="lazyload img-hover"
                                                        data-src="{{ Storage::url($product->images[0]) }}"
                                                        src="{{ Storage::url($product->images[0]) }}"
                                                        alt="{{ $product->name }}" />
                                                </a>
                                            </div>
                                            <div class="card-product-info">
                                                <a href="{{ route('detail.product', $product->slug) }}"
                                                    class="title link">
                                                    {{ $product->name }}
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">Tidak ada produk dalam kategori ini.</p>
                                    @endforelse
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
