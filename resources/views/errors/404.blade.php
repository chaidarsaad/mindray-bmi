<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="index, follow">
    <title>Halaman tidak ditemukan | USG Mindray</title>

    {{-- Style --}}
    @livewireStyles()
    @include('includes.style')
    @stack('styles')
</head>

<body class="preload-wrapper">

    <div>
        <div id="wrapper">
            <!-- Navbar -->
            @livewire('components.navbar')
            <!-- /Navbar -->

            <!-- page-title -->
            <div style="margin-bottom: 100px;">
                @livewire('components.page-title')
            </div>
            <!-- /page-title -->

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

    @livewireScripts
    @include('includes.script')
    @stack('scripts')

    <script>
        setInterval(() => {
            fetch('/refresh-csrf', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(csrfData => {
                    document.querySelector('meta[name="csrf-token"]').setAttribute('content',
                        csrfData.csrf);
                });
        }, 2 * 60 * 1000);
    </script>
</body>

</html>
