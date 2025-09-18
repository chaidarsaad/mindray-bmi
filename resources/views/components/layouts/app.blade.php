<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="index, follow">
    @stack('meta-seo')
    <title>@yield('title')</title>

    <link rel="canonical" href="https://www.usgmindray.com/" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JC3FTSN0RY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-JC3FTSN0RY');
    </script>

    {{-- Style --}}
    @livewireStyles()
    @include('includes.style')
    @stack('styles')
</head>

<body class="preload-wrapper">
    {{ $slot }}

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
