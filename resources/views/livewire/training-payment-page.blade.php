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

        <section class="flat-spacing-17 py-4">
            <div class="container">
                <div class="p-4 rounded shadow-sm bg-white">
                    {{-- Order Details --}}
                    <div class="row gy-4">
                        <x-info-col label="Nomor Pesanan" :value="$order->order_number" />
                        <x-info-col label="Tanggal Pesan" :value="$order->created_at
                            ->setTimezone('Asia/Jakarta')
                            ->locale('id')
                            ->translatedFormat('l, d F Y H:i')" />

                        <hr>
                        <x-info-col label="Total Pembayaran" :value="'Rp ' . number_format($order->total_harga, 0, ',', '.')" />
                    </div>
                </div>
            </div>
        </section>

        {{-- detail order --}}
        <section class="flat-spacing-17 py-4">
            <div class="container">
                <div class="p-4 rounded shadow-sm bg-white">
                    <div class="row gy-4">
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
        </section>
        {{-- /detail order --}}

        {{-- petunjuk pembarayan --}}
        <section class="flat-spacing-17 pt_0">
            <div class="container">
                <div class="widget-tabs rounded p-4 bg-white shadow-sm">
                    <h5 class="mb-3">Nomor Rekening</h5>
                    <hr>

                    @foreach ($paymentMethods as $method)
                        <div class="mb-3 fs-16">
                            <p class="mb-1">Bank: <strong>{{ $method->name }}</strong></p>
                            <div class="d-flex align-items-center">
                                <span id="account-{{ $method->account_number }}"
                                    class="me-2">{{ $method->account_number }}</span>
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
                                    <span>Kirim Konfirmasi</span>
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
