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
                                        <span>Total Pembayaran</span>
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
                                        <span>Bukti Transfer</span>
                                    </div>
                                    <hr>
                                    <form class="form-checkout" action="">

                                        <fieldset class="box fieldset">
                                            <label for="payment_proof">Upload Bukti Transfer</label>
                                            <input accept="image/*" type="file" id="payment_proof">
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /detail order --}}

        <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="tf-height-observer w-100 d-flex align-items-center">
                    <div class="tf-sticky-atc-infos" style="width: 100%;">
                        <form class="" style="width: 100%;">
                            <div class="tf-sticky-atc-btns" style="width: 100%;">
                                <a href="#"
                                    class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn">
                                    <span>Kirim Komfirmasi</span>
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
