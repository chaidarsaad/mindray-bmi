@push('meta-seo')
    <meta name="description"
        content="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC. Dapatkan informasi lengkap tentang produk dan pelatihan kami di sini.">
    <meta name="keywords"
        content="usg, mindray, pelatihan, abdomen, anc, alat kesehatan, usg mindray, pelatihan usg, alat usg, usg bandung, pelatihan anc dan abdomen">
    <meta name="author" content="USG Mindray">

    <meta property="og:title" content="Pelatihan USG ANC & ABDOMEN {{ $training->judul }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="USG Mindray">
    <meta property="og:description" content="Pelatihan USG ANC & ABDOMEN {{ $training->judul }}">
    <meta property="og:image" content="{{ asset('assets/images/logo/logo USG MINDRAY BMI bulat.jpg') }}">
@endpush


@section('title')
    Pelatihan {{ $training->judul }} | USG Mindray
@endsection

@push('styles')
    <style>
        /* Menambahkan aturan untuk konten yang lebih responsif */
        .article-content {
            /* Lebih aman untuk semua bahasa (termasuk Indonesia) */
            word-break: normal;
            overflow-wrap: break-word;
            hyphens: auto;

            /* Layout tetap responsif */
            max-width: 100%;
            box-sizing: border-box;
        }

        iframe {
            position: relative;
            width: 100%;
            height: auto;
            max-width: 100%;
        }

        /* Membuat video responsif dengan rasio 16:9 */
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* Rasio 16:9 */
            height: 0;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }


        .training-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .training-image {
                max-width: 600px;
                /* atau ukuran yang kamu inginkan */
            }
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
                                    <img class="training-image" data-src="{{ Storage::url($training->image) }}"
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

                            <hr>
                            <div class="desc article-content text-center">
                                <strong style="font-size: 24px; color: #0105da;">REGISTRASI :</strong><br><br>

                                @if ($paymentMethods)
                                    @foreach ($paymentMethods as $data)
                                        <p style="font-size:18px;">
                                            <span style="font-weight: bold;">{{ $data->name }} :</span>
                                            <span id="account-{{ $loop->index }}">{{ $data->account_number }}</span>

                                            <button type="button"
                                                onclick="copyToClipboard('account-{{ $loop->index }}')"
                                                style="margin-left: 2px;background: none; border: none; cursor: pointer;"
                                                title="Salin nomor rekening">
                                                <i class="fa-regular fa-paste"
                                                    style="color: #0105da; font-size: 16px;"></i>
                                            </button>
                                        </p>
                                    @endforeach
                                    <p style="font-size:18px;">
                                        a.n. {{ $accountName->account_name }}
                                    </p>
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
                                        style="pointer-events: none; cursor: not-allowed;">
                                        Sudah Terselenggara
                                    </span>
                                @else
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
</div>

@push('scripts')
    <script>
        function copyToClipboard(id) {
            const element = document.getElementById(id);
            const text = element.innerText;

            navigator.clipboard.writeText(text).then(function() {
                showToast("Nomor rekening berhasil disalin!");
            }, function() {
                showToast("Gagal menyalin.", "red");
            });
        }

        function showToast(message, bgColor = "#4caf50") {
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: bgColor,
                stopOnFocus: true,
            }).showToast();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const iframes = document.querySelectorAll('iframe');
            iframes.forEach(function(iframe) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('video-container');
                iframe.parentNode.insertBefore(wrapper, iframe);
                wrapper.appendChild(iframe);
            });
        });
    </script>
@endpush
