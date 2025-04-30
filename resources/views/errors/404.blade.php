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

    <style>
        footer ul,
        footer li {
            list-style: none !important;
            padding-left: 0 !important;
        }

        footer .footer-infor ul {
            list-style-type: none !important;
            padding-left: 0 !important;
        }

        .whatsapp-chat {
            position: fixed;
            bottom: 80px;
            right: 15px;
            background: #0105da;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 0.1);
            font-size: 0.75rem;
            font-weight: bold;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            user-select: none;
            z-index: 100;
        }

        .whatsapp-chat a {
            color: white;
            font-size: 1.25rem;
            text-decoration: none;
        }

        @media (min-width: 768px) {
            .whatsapp-chat {
                bottom: 120px;
                right: 30px;
            }
        }
    </style>
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
