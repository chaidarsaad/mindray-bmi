@section('title')
    USG Mindray | Pembayaran Pelatihan
@endsection

@push('styles')
    <style>
        .btn-outline-primary:hover {
            background-color: #0105da;
            color: #fff;
            border-color: #0105da;
        }

        .training-image {
            width: 100%;
            max-width: 150px;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 8px;
        }

        .training-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 576px) {
            .training-image {
                max-width: 100%;
            }

            .training-image img {
                object-fit: contain;
                background-color: #f8f9fa;
            }
        }
    </style>
@endpush

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        <section class="flat-spacing-17 py-4">
            <div class="container">
                <div class="alert alert-{{ $statusInfo['color'] }} d-flex align-items-center p-3 rounded mb-4"
                    role="alert" style="font-size: 18px;">
                    <i class="bi {{ $statusInfo['icon'] }} me-3 fs-4 text-{{ $statusInfo['color'] }}"></i>
                    <div>
                        <p class="mb-1 fw-bold text-{{ $statusInfo['color'] }}">{{ $statusInfo['title'] }}</p>
                        <p class="mb-0 small text-{{ $statusInfo['color'] }}">{{ $statusInfo['message'] }}</p>
                    </div>
                </div>

                <div class="p-4 rounded shadow-sm bg-white">
                    {{-- Order Header --}}
                    <div class="d-flex align-items-center mb-4">
                        <figure class="training-image me-3 mb-0">
                            <img src="{{ Storage::url($firstTraining->image) }}" alt="product">
                        </figure>

                        <div>
                            <span class="badge bg-{{ $statusInfo['color'] }} mb-2 text-capitalize fs-14">
                                <i class="{{ $statusInfo['icon'] }} me-1"></i> {{ $statusInfo['title'] }}
                            </span>
                            <p class="mb-0 fs-16 fw-semibold text-dark">Nomor Pesanan: <br><span
                                    class="text-secondary fs-18">{{ $order->order_number }}</span></p>
                        </div>
                    </div>

                    {{-- Order Details --}}
                    <div class="row gy-4">
                        <x-info-col label="Nama Pelatihan" :value="$firstTraining->judul" />
                        <x-info-col label="Tanggal Pesan" :value="$order->created_at
                            ->setTimezone('Asia/Jakarta')
                            ->locale('id')
                            ->translatedFormat('l, d F Y H:i')" />
                        <x-info-col label="Nama Pemesan" :value="$order->name" />
                        <x-info-col label="Email" :value="$order->email" />
                        <x-info-col label="Nomor HP" :value="$order->phone" />

                        @foreach ($orderDetailsFormatted as $detail)
                            <hr>
                            <x-info-col label="Jenis Pelatihan" :value="$detail['jenis']" />
                            <x-info-col label="Kota" :value="$detail['kota']" />
                            <x-info-col label="Tempat" :value="$detail['tempat']" />
                            <x-info-col label="Jadwal" :value="$detail['jadwal']['start'] . ' - ' . $detail['jadwal']['end']" />
                            <x-info-col label="Harga" :value="'Rp ' . number_format($detail['harga'], 0, ',', '.')" />
                        @endforeach

                        <hr>
                        <x-info-col label="Total Harga" :value="'Rp ' . number_format($order->total_harga, 0, ',', '.')" />
                    </div>
                </div>
            </div>
        </section>

        @if ($order->payment_proof)
            <section class="flat-spacing-17 py-4">
                <div class="container">
                    <div class="p-4 rounded shadow-sm bg-white">
                        <p class="mb-3 fs-16 fw-semibold text-dark">Bukti Pembayaran</p>
                        <div class="d-flex justify-content-center">
                            <img src="{{ Storage::url($order->payment_proof) }}" alt="Bukti Pembayaran"
                                class="img-fluid rounded" style="max-width: 100%; height: auto;" />
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- petunjuk pembarayan --}}
        <section class="flat-spacing-17 pt_0">
            <div class="container">
                <div class="widget-tabs rounded p-4 bg-white shadow-sm">
                    <h5 class="fw-bold mb-3">Petunjuk Pembayaran</h5>
                    <hr>

                    @foreach ($paymentMethods as $method)
                        <div class="mb-3 fs-16">
                            <p class="mb-1">Bank: <strong>{{ $method->name }}</strong></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <span id="account-{{ $method->account_number }}">
                                    {{ $method->account_number }}
                                </span>
                                <button type="button"
                                    onclick="copyToClipboard('account-{{ $method->account_number }}')"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fa-regular fa-paste me-1"></i> Salin
                                </button>
                            </div>

                            <p class="mb-0 mt-1">a.n. <strong>{{ $method->account_name }}</strong></p>
                        </div>
                        <hr>
                    @endforeach

                    <ul class="mb-0 fs-15">
                        <li>• Transfer sesuai dengan nominal yang tertera</li>
                        <li>• Simpan bukti pembayaran</li>
                        <li>• Upload bukti pembayaran setelah transfer</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="tf-height-observer w-100 d-flex align-items-center">
                    <div class="tf-sticky-atc-infos" style="width: 100%;">
                        <form class="" style="width: 100%;">
                            <div class="tf-sticky-atc-btns" style="width: 100%;">
                                @if ($order->status === 'cancelled')
                                    <button
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn"
                                        disabled>
                                        <span>Pesanan Dibatalkan</span>
                                    </button>
                                @elseif ($order->payment_proof)
                                    <button
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn"
                                        disabled>
                                        <span>Bukti Pembayaran Terkirim</span>
                                    </button>
                                @else
                                    <a href="{{ route('payment.training.confirmation', $order->order_number) }}"
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn">
                                        <span>Konfirmasi Pembayaran</span>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


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

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let message = @json(session('notify-success'));

            if (message) {
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "green",
                }).showToast();
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            let message = @json(session('notify-error'));

            if (message) {
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red",
                }).showToast();
            }
        });

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
    </script>
@endpush
