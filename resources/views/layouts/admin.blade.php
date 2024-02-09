@php
$path = str_replace(config('app.url'), '', url()->current());
$active_link = $path ?: '/';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('assets/icons/mstile-70x70.png') }}">
        <meta name="theme-color" content="#ffffff" />
        <meta name="author" content="Holger Schatte">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-32x32.ico') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-16x16.ico') }}" sizes="16x16">
        <link rel="apple-touch-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/apple-touch-icon-180x180.png') }}">
        <link rel="android-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/android-icon-192x192.png') }}">

        @yield('title')
        
        @vite('resources/assets/css/app.css')

        @vite('resources/assets/js/app.js')
        
    </head>

    <body>
        <x-navbar-admin :active="$active_link" />

        <main class="panel">
            @if(session('message'))
                <x-modal :message="session('message')" :status="session('status')" />
            @endif

            @yield('content')
        </main>

    </body>
</html>
