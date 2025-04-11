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
                                        @forelse ($this->orders as $order)
                                            <tr class="tf-order-item">
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->created_at->translatedFormat('l, d F Y') }}</td>
                                                <td>{{ ucfirst($order->status_title) }}</td>
                                                {{-- <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }} untuk
                                                    {{ $order->order_details_count }} item</td> --}}
                                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('detail.training.order', $order->order_number) }}"
                                                        class="tf-btn btn-fill tf-btn-process animate-hover-btn rounded-0 justify-content-center">
                                                        <span>Lihat</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Belum ada pesanan.</td>
                                            </tr>
                                        @endforelse
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
