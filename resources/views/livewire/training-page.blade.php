@push('meta-seo')
    <meta name="description"
        content="Supplier alat USG Mindray dan Penyelenggara Pelatihan USG Abdomen & ANC. Dapatkan informasi lengkap tentang produk dan pelatihan kami di sini.">
    <meta name="keywords"
        content="usg, mindray, pelatihan, abdomen, anc, alat kesehatan, usg mindray, pelatihan usg, alat usg, usg bandung, pelatihan anc dan abdomen, produk usg mindray">
    <meta name="author" content="USG Mindray">

    <meta property="og:title" content="Pelatihan USG Abdomen & ANC">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="USG Mindray">
    <meta property="og:description" content="Semua Pelatihan USG Abdomen & ANC">
    <meta property="og:image" content="{{ Storage::url($about->logo) }}">
@endpush

@section('title')
    Semua Pelatihan | USG Mindray
@endsection

<div>
    <div id="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        <!-- Pelatihan -->
        <div>
            @if ($trainings->count())
                <section class="flat-spacing-6 pb_0 training-scroll">
                    <div class="blog-grid-main">
                        <div class="container">
                            <div class="row">
                                @foreach ($trainings as $training)
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="blog-article-item">
                                            <div class="article-thumb">
                                                <a href="{{ route('detail.training', $training->slug) }}">
                                                    <img class="" data-src="{{ Storage::url($training->image) }}"
                                                        src="{{ Storage::url($training->image) }}"
                                                        alt="{{ $training->judul }}" />
                                                </a>
                                            </div>
                                            <div class="article-content">
                                                <div class="article-title">
                                                    <a style="text-align: center;"
                                                        href="{{ route('detail.training', $training->slug) }}"
                                                        class="text-center">{{ $training->judul }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-0 d-flex justify-content-center">
                            {{ $trainings->links('pagination::bootstrap-4') }}
                        </div>
                </section>
            @endif
        </div>
        <!-- /Pelatihan -->

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
        document.addEventListener('livewire:navigated', () => {
            if (sessionStorage.getItem('paginationScroll') === 'true') {
                const el = document.querySelector('.training-scroll');
                if (el) {
                    setTimeout(() => {
                        el.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }, 50);
                }
                sessionStorage.removeItem('paginationScroll');
            }
        });

        document.addEventListener('click', function(e) {
            const target = e.target.closest('a');
            if (target && target.closest('.pagination')) {
                sessionStorage.setItem('paginationScroll', 'true');
            }
        });
    </script>
@endpush
