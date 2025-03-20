@section('title')
    BMI | Proses Pesanan
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
                        <h5 class="fw-5 mb_20">Data pemesan</h5>
                        <form class="form-checkout">
                            <fieldset class="box fieldset">
                                <label for="address">Nama</label>
                                <input type="text" id="address">
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="address">Alamat</label>
                                <input type="text" id="address">
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="phone">Nomor HP</label>
                                <input type="number" id="phone">
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="email">Email</label>
                                <input type="email" id="email">
                            </fieldset>
                            <div class="box fieldset">
                                <label for="note">Catatan tambahan (optional)</label>
                                <textarea name="note" id="note"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="tf-page-cart-footer">
                        <div class="tf-cart-footer-inner">
                            <h5 class="fw-5 mb_20">Item Dipesan</h5>
                            <form class="tf-page-cart-checkout widget-wrap-checkout">
                                <ul class="wrap-checkout-product">
                                    <li class="checkout-product-item">
                                        <figure class="img-product">
                                            <img src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="product">
                                            <span class="quantity">1</span>
                                        </figure>
                                        <div class="content">
                                            <div class="info">
                                                <p class="name">Ribbed modal T-shirt</p>
                                                <span class="variant">Brown / M</span>
                                            </div>
                                            <span class="price">$25.00</span>
                                        </div>
                                    </li>
                                    <li class="checkout-product-item">
                                        <figure class="img-product">
                                            <img src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                alt="product">
                                            <span class="quantity">1</span>
                                        </figure>
                                        <div class="content">
                                            <div class="info">
                                                <p class="name">Vanilla White</p>
                                            </div>
                                            <span class="price">$35.00</span>
                                        </div>
                                    </li>
                                </ul>

                                <div class="d-flex justify-content-between line pb_20">
                                    <h6 class="fw-5">Total</h6>
                                    <h6 class="total fw-5">$122.00</h6>
                                </div>
                                <button
                                    class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Proses
                                    Pesanan</button>
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
