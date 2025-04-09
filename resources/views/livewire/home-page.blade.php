@section('title')
    USG Mindray | Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- Carousel -->
        @livewire('components.carousel')
        <!-- /Carousel -->

        <!-- Produk -->
        @livewire('components.product')
        <!-- /Produk -->

        <!-- Pelatihan -->
        @livewire('components.training')
        <!-- /Pelatihan -->

        <!-- Artikel -->
        @livewire('components.article')
        <!-- /Artikel -->

        <!-- Testimonial -->
        @livewire('components.testimonials')
        <!-- /Testimonial -->

        <!-- Features -->
        @livewire('components.features')
        <!-- /Features -->

        <!-- Question -->
        @livewire('components.question')
        <!-- /Question -->

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
            let message = @json(session('notify-error'));

            if (message) {
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red",
                }).showToast();
            }
        });
    </script>
@endpush
