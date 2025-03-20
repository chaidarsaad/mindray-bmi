<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    {{-- Style --}}

    @include('includes.style')
    @livewireStyles()
    @stack('styles')
</head>

<body class="preload-wrapper">
    {{ $slot }}

    @include('includes.script')
    @livewireScripts
    @stack('scripts')
</body>

</html>
