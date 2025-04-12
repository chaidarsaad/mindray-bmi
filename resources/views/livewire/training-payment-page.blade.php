@section('title')
    USG Mindray | Konfirmasi Pembayaran
@endsection

@push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        .btn-outline-primary:hover {
            background-color: #0105da;
            color: #fff;
            border-color: #0105da;
        }

        .bg-light-primary {
            background-color: #e7f1ff;
        }

        .text-primary {
            color: #0105da !important;
        }

        .card-prominent {
            border: 2px solid #0105da;
        }

        .drag-drop-area {
            border: 2px dashed #0105da;
            background-color: #f8f9ff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .drag-drop-area.dragging {
            background-color: #e0e7ff;
            border-color: #0044cc;
        }

        .drag-drop-area .file-name {
            display: block;
            margin-top: 8px;
            font-size: 16px;
            color: #6c757d;
        }

        .preview-wrapper img {
            max-width: 100%;
            object-fit: contain;
        }

        .file-name {
            max-width: 100%;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
            <div class="p-4 rounded shadow-sm bg-white card-prominent">
                <div class="row gy-4">
                    {{-- Detail Pesanan --}}
                    <x-info-col label="Nomor Pesanan" :value="$order->order_number" />
                    <x-info-col label="Tanggal Pesan" :value="$order->created_at
                        ->setTimezone('Asia/Jakarta')
                        ->locale('id')
                        ->translatedFormat('l, d F Y H:i')" />
                    <hr>
                    {{-- <x-info-col label="Total Pembayaran" :value="'Rp ' . number_format($order->total_harga, 0, ',', '.')" /> --}}
                    <div class="col-12">
                        <div class="bg-light-primary border border-primary rounded p-3">
                            <div class="text-primary fw-bold fs-20 mb-1">Total Pembayaran</div>
                            <div class="fw-bold fs-20 text-primary">Rp
                                {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upload Bukti Transfer -->
    <section class="flat-spacing-17 pt_0">
        <div class="container">
            <div class="p-4 rounded shadow-sm bg-white card-prominent">
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

                            <fieldset class="box fieldset" x-data="{
                                fileName: '',
                                isDragging: false,
                                previewUrl: null
                            }">

                                <label for="payment_proof" class="form-label">Upload Bukti Transfer</label>

                                <div class="drag-drop-area" :class="{ 'dragging': isDragging }"
                                    @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                    @drop.prevent="
            isDragging = false;
            const file = $event.dataTransfer.files[0];
            fileName = file.name;
            $refs.input.files = $event.dataTransfer.files;
            previewUrl = URL.createObjectURL(file);
            $dispatch('input');
        "
                                    @click="$refs.input.click()">
                                    <span class="text-primary fw-semibold">Klik atau seret berkas ke sini</span>
                                    <span class="file-name text-secondary mt-2"
                                        x-text="fileName || 'Belum ada file dipilih'"></span>
                                    <input type="file" wire:model="payment_proof" id="payment_proof" accept="image/*"
                                        class="d-none" x-ref="input"
                                        @change="
                fileName = $refs.input.files[0]?.name;
                previewUrl = URL.createObjectURL($refs.input.files[0]);
            " />
                                </div>

                                <!-- Preview -->
                                <template x-if="previewUrl">
                                    <div class="preview-wrapper mt-3 text-center">
                                        <p class="text-secondary mb-2">Pratinjau Gambar:</p>
                                        <img :src="previewUrl" alt="Preview" class="img-fluid rounded border"
                                            style="max-height: 300px;">
                                    </div>
                                </template>

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

    {{-- petunjuk pembarayan --}}
    <section class="flat-spacing-17 pt_0">
        <div class="container">
            <div class="widget-tabs rounded p-4 bg-white shadow-sm card-prominent">
                <h5 class="fw-bold mb-3">Petunjuk Pembayaran</h5>
                <hr>

                @foreach ($paymentMethods as $method)
                    <div class="mb-3 fs-16">
                        <p class="mb-1">Bank: <strong>{{ $method->name }}</strong></p>
                        <div class="d-flex align-items-center justify-content-between">
                            <span id="account-{{ $method->account_number }}">
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

                <ul class="mb-0 fs-15">
                    <li>• Transfer sesuai dengan nominal yang tertera</li>
                    <li>• Simpan bukti pembayaran</li>
                    <li>• Upload bukti pembayaran setelah transfer</li>
                </ul>
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
