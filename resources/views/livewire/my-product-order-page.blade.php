@section('title')
    USG Mindray | Pesanan Produk USG
@endsection

@push('styles')
    <style>
        .scroll-hint-deskripsi {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            margin-top: 5px;
            display: none;
        }

        .scroll-hint-deskripsi {
            display: block;
        }
    </style>
@endpush

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
                            <div class="wrap-account-order" style="overflow-x: auto;">
                                <table style="min-width: 600px;">
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
                                        @forelse ($orders as $order)
                                            <tr class="tf-order-item">
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->created_at->translatedFormat('l, d F Y H:i') }}</td>
                                                <td>{{ ucfirst($order->status_title) }}</td>
                                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('detail.product.order', $order->order_number) }}"
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
                            <div class="scroll-hint-deskripsi">
                                Geser kesamping untuk melihat detail pesanan →
                            </div>
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $orders->links('pagination::bootstrap-4') }}
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
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:navigated', () => {
            const el = document.querySelector('.account-order');
            if (el) {
                setTimeout(() => {
                    el.scrollIntoView({
                        behavior: 'smooth'
                    });
                }, 50);
            }
        });
    </script>
@endpush
