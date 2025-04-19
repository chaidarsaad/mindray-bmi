@section('title')
    Daftar Pelatihan | USG Mindray
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        {{-- checkout --}}
        <section class="flat-spacing-11">
            <div class="container">
                <div class="tf-page-cart-wrap layout-2">
                    <div class="tf-page-cart-item">
                        <h5 class="fw-5 mb_20">Data pendaftar</h5>
                        <form class="form-checkout" wire:submit.prevent="checkout">
                            <fieldset class="box fieldset">
                                <label for="name">Nama</label>
                                <input oninput="this.value = this.value.toLowerCase()" wire:model="name" type="text"
                                    id="name">
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="email">Email</label>
                                <input wire:model="email" type="email" id="email">
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="phone">Nomor HP</label>
                                <input wire:model="phone_number" type="tel" id="phone">
                            </fieldset>

                            <hr>
                            <div class="alert alert-info py-2 px-3 mb-4">
                                <strong>Catatan:</strong> Pelatihan di bawah ini dapat dipilih <u>salah satu</u> atau
                                <u>keduanya</u>, sesuai kebutuhan Anda.
                            </div>

                            <fieldset class="box fieldset">
                                <label for="anc">Pelatihan ANC</label>
                                <div class="select-custom">
                                    <select wire:model="selected_anc" class="tf-select w-100" id="anc"
                                        onchange="calculateTotal()">
                                        <option value="">Pilih Pelatihan ANC</option>
                                        @foreach ($trainingPricesANC as $price)
                                            <option value="{{ $price->id }}" data-price="{{ $price->price }}"
                                                @if ($price->is_past) disabled @endif>
                                                @php
                                                    $startDate = \Carbon\Carbon::parse($price->start_date);
                                                    $endDate = \Carbon\Carbon::parse($price->end_date);
                                                @endphp
                                                {{ $price->city->name }} ({{ $price->place }}) Rp
                                                {{ number_format($price->price) }} -
                                                {{ $startDate->locale('id')->translatedFormat('l, d') }} s.d.
                                                {{ $endDate->locale('id')->translatedFormat('l, d F Y') }}
                                                @if ($price->is_past)
                                                    - (Sudah Terselenggara)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="abdomen">Pelatihan ABDOMEN</label>
                                <div class="select-custom">
                                    <select wire:model="selected_abdomen" class="tf-select w-100" id="abdomen"
                                        onchange="calculateTotal()">
                                        <option value="">Pilih Pelatihan ABDOMEN</option>
                                        @foreach ($trainingPricesAbdomen as $price)
                                            <option value="{{ $price->id }}" data-price="{{ $price->price }}"
                                                @if ($price->is_past) disabled @endif>
                                                @php
                                                    $startDate = \Carbon\Carbon::parse($price->start_date);
                                                    $endDate = \Carbon\Carbon::parse($price->end_date);
                                                @endphp
                                                {{ $price->city->name }} ({{ $price->place }}) Rp
                                                {{ number_format($price->price) }} -
                                                {{ $startDate->locale('id')->translatedFormat('l, d') }} s.d.
                                                {{ $endDate->locale('id')->translatedFormat('l, d F Y') }}
                                                @if ($price->is_past)
                                                    - (Sudah Terselenggara)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <hr>

                        </form>
                    </div>
                    <div class="tf-page-cart-footer">
                        <div class="tf-cart-footer-inner">
                            <h5 class="fw-5 mt_37">Pelatihan Dipesan</h5>
                            <form class="tf-page-cart-checkout widget-wrap-checkout">
                                <ul class="wrap-checkout-product">
                                    <li class="checkout-product-item">
                                        <figure class="img-product">
                                            <img src="{{ Storage::url($training->image) }}" alt="product">
                                        </figure>
                                        <div class="content">
                                            <div class="info">
                                                <p class="name">{{ $training->judul }}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <div class="d-flex justify-content-between line pb_20">
                                    <h6 class="fw-5">Total</h6>
                                    <h6 class="total fw-5" id="total_harga">
                                        @if ($selected_anc && $selected_abdomen)
                                            @php
                                                $anc = $trainingPricesANC->firstWhere('id', $selected_anc);
                                                $abdomen = $trainingPricesAbdomen->firstWhere('id', $selected_abdomen);
                                                $total = $anc && $abdomen ? $anc->price + $abdomen->price : 0;
                                            @endphp
                                            Rp {{ number_format($total, 0, ',', '.') }}
                                        @else
                                            Rp 0
                                        @endif
                                    </h6>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tf-sticky-btn-atc">
                <div class="container">
                    <div class="tf-height-observer w-100 d-flex align-items-center">
                        <div class="tf-sticky-atc-product d-flex align-items-center">
                            <div class="tf-sticky-atc-img">
                                <img class="ed" data-src="" alt=""
                                    src="{{ Storage::url($training->image) }}">
                            </div>
                            <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">{{ $training->judul }}</div>
                        </div>
                        <div class="tf-sticky-atc-infos">
                            <form class="" wire:submit.prevent="checkout">
                                <div class="tf-sticky-atc-btns">
                                    <button type="submit" wire:loading.attr="disabled"
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn "><span>Konfirmasi
                                            Pesanan</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /checkout --}}

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
        function calculateTotal() {
            let ancSelect = document.getElementById("anc");
            let ancPrice = ancSelect.options[ancSelect.selectedIndex]?.dataset.price || 0;

            let abdomenSelect = document.getElementById("abdomen");
            let abdomenPrice = abdomenSelect.options[abdomenSelect.selectedIndex]?.dataset.price || 0;

            let total = parseInt(ancPrice) + parseInt(abdomenPrice);
            document.getElementById("total_harga").innerText = "Rp " + total.toLocaleString("id-ID");
        }
    </script>

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
    </script>
@endpush
