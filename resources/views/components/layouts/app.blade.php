<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="index, follow">
    @stack('meta-seo')
    <title>@yield('title')</title>

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
</body>

</html>
