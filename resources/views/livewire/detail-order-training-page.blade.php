@section('title')
    USG Mindray | Pembayaran Pelatihan
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        {{-- detail order --}}
        <section class="flat-spacing-17 pt_1">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-has-border">
                            </ul>
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active" id="description" style="font-size: 18px;">
                                    <div class="article-content d-flex justify-content-between">
                                        <span>Detail Pesanan</span>
                                        <span>{{ $order->order_number }}</span>
                                    </div>
                                    <div class="article-content d-flex justify-content-between">
                                        <span>{{ $order->created_at->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y H:i') }}</span>
                                    </div>
                                    <hr>

                                    <div class="article-content d-flex justify-content-between">
                                        <span>Nama Pelatihan:</span>
                                    </div>
                                    <div class="article-content d-flex justify-content-between">
                                        <span>{{ $firstTraining->judul ?? '-' }}</span>
                                    </div>
                                    <hr>

                                    {{-- tampilkan pelatihan yang dipesan --}}
                                    @foreach ($orderDetailsFormatted as $detail)
                                        <div class="article-content d-flex justify-content-between">
                                            <span>Jenis Pelatihan:</span>
                                            <span>{{ $detail['jenis'] }}</span>
                                        </div>
                                        <div class="article-content d-flex justify-content-between">
                                            <span>Kota:</span>
                                            <span>{{ $detail['kota'] }}</span>
                                        </div>
                                        <div class="article-content d-flex justify-content-between">
                                            <span>Tempat:</span>
                                            <span>{{ $detail['tempat'] }}</span>
                                        </div>
                                        <div class="article-content d-flex justify-content-between">
                                            <span>Jadwal:</span>
                                            <span>{{ $detail['jadwal']['start'] }} -
                                                {{ $detail['jadwal']['end'] }}</span>
                                        </div>
                                        <div class="article-content d-flex justify-content-between">
                                            <span>Harga:</span>
                                            <span>Rp{{ number_format($detail['harga'], 0, ',', '.') }}</span>
                                        </div>
                                        <hr>
                                    @endforeach


                                    <div class="article-content d-flex justify-content-between">
                                        <span>Total</span>
                                        <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /detail order --}}

        {{-- informasi pemesan --}}
        <section class="flat-spacing-17 pt_0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-has-border">
                            </ul>
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active" id="description" style="font-size: 18px;">
                                    <div class="article-content d-flex justify-content-between">
                                        <span>Data Pendaftar</span>
                                    </div>
                                    <hr>

                                    <div class="article-content d-flex justify-content-between">
                                        <span>Nama:</span>
                                        <span>{{ $order->name }}</span>
                                    </div>
                                    <div class="article-content d-flex justify-content-between">
                                        <span>Email:</span>
                                        <span>{{ $order->email }}</span>
                                    </div>
                                    <div class="article-content d-flex justify-content-between">
                                        <span>Nomor HP:</span>
                                        <span>{{ $order->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- petunjuk pembarayan --}}
        <section class="flat-spacing-17 pt_0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-has-border">
                            </ul>
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active" id="description" style="font-size: 18px;">
                                    <div class="article-content d-flex justify-content-between">
                                        <span>Petunjuk Pembayaran</span>
                                    </div>
                                    <hr>

                                    @foreach ($paymentMethods as $paymentMethods)
                                        <div class="article-content d-flex justify-content-between">
                                            <span>Nomor Rekening {{ $paymentMethods->name }}:</span>
                                        </div>
                                        <div class="article-content d-flex justify-content-between">
                                            <span id="account-{{ $paymentMethods->account_number }}">
                                                {{ $paymentMethods->account_number }}
                                            </span>


                                            <button type="button"
                                                onclick="copyToClipboard('account-{{ $paymentMethods->account_number }}')"
                                                style="margin-left: 2px;background: none; border: none; cursor: pointer;"
                                                title="Salin nomor rekening">Salin
                                                <i class="fa-regular fa-paste"
                                                    style="color: #0105da; font-size: 16px;"></i>
                                            </button>
                                        </div>
                                        <div class="article-content d-flex justify-content-between">
                                            <span>a.n. {{ $paymentMethods->account_name }}</span>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="article-content">
                                        <li>• Transfer sesuai dengan nominal yang tertera</li>
                                        <li>• Simpan bukti pembayaran</li>
                                        <li>• Upload bukti pembayaran setelah transfer</li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="tf-height-observer w-100 d-flex align-items-center">
                    <div class="tf-sticky-atc-infos" style="width: 100%;">
                        <form class="" style="width: 100%;">
                            <div class="tf-sticky-atc-btns" style="width: 100%;">
                                <a href="{{ route('payment.training.confirmation', $order->order_number) }}"
                                    class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn">
                                    <span>Komfirmasi Pembayaran</span>
                                </a>
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
