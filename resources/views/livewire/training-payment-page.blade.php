@section('title')
    USG Mindray | Konfirmasi Pembayaran
@endsection

@push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endpush

<div id="wrapper">

    <!-- Navbar -->
    @livewire('components.navbar')

    <!-- Page Title -->
    @livewire('components.page-title')

    <!-- Order Summary -->
    <section class="flat-spacing-17 py-4">
        <div class="container">
            <div class="p-4 rounded shadow-sm bg-white">
                <div class="row gy-4">
                    {{-- Detail Pesanan --}}
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

    <!-- Upload Bukti Transfer -->
    <section class="flat-spacing-17 py-4">
        <div class="container">
            <div class="p-4 rounded shadow-sm bg-white">
                <div class="row gy-4">
                    <div class="widget-content-inner active" id="description" style="font-size: 18px;">
                        <div class="d-flex justify-content-between mb-3">
                            <span><strong>Bukti Transfer</strong></span>
                        </div>
                        <hr>
                        <form wire:submit.prevent="submit" class="form-checkout" action="" x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <fieldset class="box fieldset">
                                <label for="payment_proof">Upload Bukti Transfer</label>
                                <input type="file" wire:model="payment_proof" id="payment_proof" class="form-control"
                                    accept="image/*">
                            </fieldset>


                            <!-- Progress Bar Bootstrap -->
                            <div x-show="isUploading" x-cloak class="mt-3">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                        role="progressbar" x-bind:style="'width: ' + progress + '%'"
                                        x-text="progress + '%'">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Petunjuk Pembayaran -->
    <section class="flat-spacing-17 pt_0">
        <div class="container">
            <div class="widget-tabs rounded p-4 bg-white shadow-sm">
                <h5 class="mb-3">Nomor Rekening</h5>
                <hr>

                @foreach ($paymentMethods as $method)
                    <div class="mb-3 fs-16">
                        <p class="mb-1">Bank: <strong>{{ $method->name }}</strong></p>
                        <div class="d-flex align-items-center">
                            <span id="account-{{ $method->account_number }}" class="me-2">
                                {{ $method->account_number }}
                            </span>
                            <button type="button" onclick="copyToClipboard('account-{{ $method->account_number }}')"
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

    <!-- Tombol Konfirmasi -->
    <div class="tf-sticky-btn-atc">
        <div class="container">
            <div class="tf-height-observer w-100 d-flex align-items-center">
                <div class="tf-sticky-atc-infos w-100">
                    <form wire:submit.prevent="submit">
                        <div class="tf-sticky-atc-btns w-100">
                            <button type="submit"
                                class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn">
                                <span>Kirim Konfirmasi</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @livewire('components.footer')

    <!-- WhatsApp -->
    @livewire('components.whatsapp')

    <!-- Mobile Menu -->
    @livewire('components.mobile-menu')

    <!-- Sidebar Cart -->
    @livewire('components.sidebar-shopping-cart')

</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("notify-error", event => {
                const message = event.detail.message || "Terjadi kesalahan, coba lagi.";

                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red",
                }).showToast();
            });
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
