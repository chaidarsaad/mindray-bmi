@section('title')
    BMI | Keranjang Belanja
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        {{-- cart --}}
        <section class="flat-spacing-11">
            <div class="container">
                {{-- empty cart --}}
                {{-- <div class="tf-page-cart text-center mt_140 mb_200">
                    <h5 class="mb_24">Your cart is empty</h5>
                    <p class="mb_24">You may check out all the available products and buy some in the shop</p>
                    <a href="shop-default.html" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Return
                        to shop<i class="icon icon-arrow1-top-left"></i></a>
                </div> --}}
                {{-- /empty cart --}}

                <div class="tf-page-cart-wrap">
                    <div class="tf-page-cart-item">
                        <form>
                            <table class="tf-table-page-cart">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        {{-- <th>Price</th> --}}
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="tf-cart-item file-delete">
                                        <td class="tf-cart-item_product">
                                            <a href="product-detail.html" class="img-box">
                                                <img src="{{ asset('assets/images/products/Mindray BeneHeart R3 Electrocardiograph.png') }}"
                                                    alt="img-product">
                                            </a>
                                            <div class="cart-info">
                                                <a href="product-detail.html" class="cart-title link">Mindray
                                                    BeneHeart R3 Electrocardiograph</a>
                                                {{-- <div class="cart-meta-variant">White / M</div> --}}
                                                <span class="remove-cart link remove text-danger">Hapus</span>
                                            </div>
                                        </td>
                                        {{-- <td class="tf-cart-item_price" cart-data-title="Price">
                                            <div class="cart-price">$18.00</div>
                                        </td> --}}
                                        <td class="tf-cart-item_quantity" cart-data-title="Jumlah">
                                            <div class="cart-quantity">
                                                <div class="wg-quantity">
                                                    <span class="btn-quantity minus-btn">
                                                        <svg class="d-inline-block" width="9" height="1"
                                                            viewBox="0 0 9 1" fill="currentColor">
                                                            <path
                                                                d="M9 1H5.14286H3.85714H0V1.50201e-05H3.85714L5.14286 0L9 1.50201e-05V1Z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <input type="text" name="number" value="1">
                                                    <span class="btn-quantity plus-btn">
                                                        <svg class="d-inline-block" width="9" height="9"
                                                            viewBox="0 0 9 9" fill="currentColor">
                                                            <path
                                                                d="M9 5.14286H5.14286V9H3.85714V5.14286H0V3.85714H3.85714V0H5.14286V3.85714H9V5.14286Z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="tf-cart-item_total" cart-data-title="Total">
                                            <div class="cart-total">$18.00</div>
                                        </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                            <div class="tf-page-cart-note">
                                <label for="cart-note">Tambah Catatan Pesanan (Opsional)</label>
                                <textarea name="note" id="cart-note"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tf-sticky-btn-atc">
                <div class="container">
                    <div class="tf-height-observer w-100 d-flex align-items-center">
                        <div class="tf-sticky-atc-product d-flex align-items-center">
                            <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">3 item</div>
                        </div>
                        <div class="tf-sticky-atc-infos">
                            <form class="">
                                <div class="tf-sticky-atc-btns">
                                    {{-- <div class="tf-product-info-quantity">
                                        <div class="wg-quantity">
                                            <span class="btn-quantity minus-btn">-</span>
                                            <input type="text" name="number" value="1">
                                            <span class="btn-quantity plus-btn">+</span>
                                        </div>
                                    </div> --}}
                                    <a href="{{ route('checkout') }}"
                                        class="tf-btn tf-btn-process btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn ">Lanjutkan
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /cart --}}

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
