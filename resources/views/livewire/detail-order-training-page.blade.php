@section('title')
    BMI | Pembayaran Pelatihan
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


                                    <hr>
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
        <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="tf-height-observer w-100 d-flex align-items-center">
                    <div class="tf-sticky-atc-infos" style="width: 100%;">
                        <form class="" style="width: 100%;">
                            <div class="tf-sticky-atc-btns" style="width: 100%;">
                                <a href="#"
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
    </script>
@endpush
