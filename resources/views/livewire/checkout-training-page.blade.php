@section('title')
    BMI | Daftar Pelatihan
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
                        <form class="form-checkout">
                            <fieldset class="box fieldset">
                                <label for="name">Nama</label>
                                <input wire:model="registrationTrainingData.name" type="text" id="name">
                                @error('registrationTrainingData.name')
                                    <span class="text-lg mt_1">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="email">Email</label>
                                <input wire:model="registrationTrainingData.email" type="email" id="email">
                                @error('registrationTrainingData.email')
                                    <span class="text-lg mt_1">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="phone">Nomor HP</label>
                                <input wire:model="registrationTrainingData.phone_number" type="number" id="phone">
                                @error('registrationTrainingData.phone_number')
                                    <span class="text-lg mt_1">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="anc">Pelatihan ANC</label>
                                <div class="select-custom">
                                    <select class="tf-select w-100" id="anc" onchange="calculateTotal()">
                                        <option value="">Pilih Pelatihan ANC</option>
                                        @foreach ($trainingPricesANC as $price)
                                            <option value="{{ $price->price }}">
                                                {{ $price->city->name }} - Rp {{ number_format($price->price) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="abdomen">Pelatihan ABDOMEN</label>
                                <div class="select-custom">
                                    <select class="tf-select w-100" id="abdomen" onchange="calculateTotal()">
                                        <option value="">Pilih Pelatihan ABDOMEN</option>
                                        @foreach ($trainingPricesAbdomen as $price)
                                            <option value="{{ $price->price }}">
                                                {{ $price->city->name }} - Rp {{ number_format($price->price) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
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
                                    <h6 class="total fw-5" id="total_harga">Rp 0</h6>
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
                            <form class="">
                                <div class="tf-sticky-atc-btns">
                                    <button wire:click="createOrderTraining"
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

    <!-- shoppingCart -->
    @livewire('components.sidebar-shopping-cart')
    <!-- /shoppingCart -->
</div>

@push('scripts')
    <script>
        function calculateTotal() {
            let ancPrice = document.getElementById("anc").value || 0;
            let abdomenPrice = document.getElementById("abdomen").value || 0;
            let total = parseInt(ancPrice) + parseInt(abdomenPrice);
            document.getElementById("total_harga").innerText = "Rp " + total.toLocaleString("id-ID");
        }
    </script>
@endpush
