@section('title')
    BMI | Detail Pelatihan
@endsection

@push('styles')
    <style>
        /* Menambahkan aturan untuk konten yang lebih responsif */
        .article-content {
            word-wrap: break-word;
            /* Memecah kata yang terlalu panjang */
            overflow-wrap: break-word;
            /* Menambahkan kompatibilitas browser */
            word-break: break-all;
            /* Memastikan kata panjang dipecah jika perlu */
            max-width: 100%;
            /* Membatasi lebar konten */
            box-sizing: border-box;
            /* Pastikan padding dan margin tidak menambah lebar elemen */
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
                                <div class="title">{{ $training->judul }}</div>
                                <div class="image">
                                    <img class="" data-src="{{ Storage::url($training->image) }}"
                                        src="{{ Storage::url($training->image) }}" alt="">
                                </div>
                            </div>

                            <hr>
                            <div class="desc article-content text-center">
                                <strong style="font-size: 24px; color: #0105da;">WAKTU dan TEMPAT :</strong><br><br>

                                @if ($trainingPricesGrouped)
                                    @foreach ($trainingPricesGrouped as $data)
                                        <p style="font-size:18px; font-weight: bold;">{{ strtoupper($data['city']) }} -
                                            {{ strtoupper($data['place']) }}</p>

                                        @foreach ($data['datesByType'] as $trainingType => $dates)
                                            @foreach ($dates as $date)
                                                <p style="font-size: 18px;">
                                                    {{ $trainingType }} ( {{ $date }} )
                                                </p>
                                            @endforeach
                                        @endforeach
                                        <br>
                                    @endforeach
                                @else
                                    <p class="text-center">Tidak ada informasi waktu dan tempat yang tersedia.</p>
                                @endif
                            </div>










                            <hr>
                            <div class="desc article-content text-center">
                                <strong style="font-size: 24px; color: #0105da;">INVESTASI :</strong><br><br>

                                @if ($trainingPricesWithPrice)
                                    @foreach ($trainingPricesWithPrice as $data)
                                        <p style="font-size:18px; font-weight: bold;">{{ strtoupper($data['city']) }}
                                        </p>
                                        @foreach ($data['prices'] as $price)
                                            <p style="font-size: 18px;">{{ $price['trainingType'] }} -
                                                {{ $price['price'] }}</p>
                                        @endforeach
                                        <br>
                                    @endforeach
                                @else
                                    <p class="text-center">Tidak ada informasi harga yang tersedia.</p>
                                @endif
                            </div>


                            <div class="desc article-content">
                                {!! $training->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="tf-height-observer w-100 d-flex align-items-center">
                    <div class="tf-sticky-atc-infos" style="width: 100%;">
                        <form class="" style="width: 100%;">
                            <div class="tf-sticky-atc-btns" style="width: 100%;">
                                @if ($isPastDate)
                                    <span
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn"
                                        style="pointer-events: none;">
                                        Sudah Terselenggara
                                    </span>
                                @else
                                    <!-- Jika belum lewat, tombol tetap aktif -->
                                    <a href="{{ route('checkout.training', $training->slug) }}"
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn">
                                        <span>Pesan</span>
                                    </a>
                                @endif
                            </div>
                        </form>
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

    <!-- shoppingCart -->
    @livewire('components.sidebar-shopping-cart')
    <!-- /shoppingCart -->
</div>
