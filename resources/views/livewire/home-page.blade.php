@push('meta-seo')
    <meta name="description"
        value="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC. Dapatkan informasi lengkap tentang produk dan pelatihan kami di sini.">
    <meta name="keywords"
        value="usg, mindray, pelatihan, abdomen, anc, alat kesehatan, usg mindray, pelatihan usg, alat usg, usg bandung, pelatihan anc dan abdomen">
    <meta name="author" value="USG Mindray">
    <meta property="og:title" value="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC">
    <meta property="og:description"
        value="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC. Dapatkan informasi lengkap tentang produk dan pelatihan kami di sini.">
    <meta property="og:image" value="{{ asset('assets/images/logo/logo USG MINDRAY BMI bulat.jpg') }}">
    <meta property="og:url" value="{{ url()->current() }}">
@endpush

@section('title')
    Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC | USG Mindray
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
