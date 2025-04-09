@section('title')
    USG Mindray | Pesanan Saya
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        {{-- my-account --}}
        <section class="flat-spacing-11">
            <div class="container">
                <div class="row">
                    @livewire('components.sidebar-dashboard')
                    <div class="col-lg-9">
                        <div class="my-account-content account-order">
                            <div class="wrap-account-order">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="fw-6">No Pesanan</th>
                                            <th class="fw-6">Tanggal</th>
                                            <th class="fw-6">Status</th>
                                            <th class="fw-6">Total</th>
                                            <th class="fw-6">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="tf-order-item">
                                            <td>
                                                #123
                                            </td>
                                            <td>
                                                August 1, 2024
                                            </td>
                                            <td>
                                                On hold
                                            </td>
                                            <td>
                                                $200.0 for 1 items
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                    <span>View</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="tf-order-item">
                                            <td>
                                                #345
                                            </td>
                                            <td>
                                                August 2, 2024
                                            </td>
                                            <td>
                                                On hold
                                            </td>
                                            <td>
                                                $300.0 for 1 items
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                    <span>View</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="tf-order-item">
                                            <td>
                                                #567
                                            </td>
                                            <td>
                                                August 3, 2024
                                            </td>
                                            <td>
                                                On hold
                                            </td>
                                            <td>
                                                $400.0 for 1 items
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                    <span>View</span>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /my-account --}}

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
