@php
$path = str_replace(config('app.url'), '', url()->current());
$active_link = $path ?: '/';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('meta')

        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('assets/icons/mstile-70x70.png') }}">
        <meta name="theme-color" content="#ffffff" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Zahnarztpraxis Dr. Sebastian Fotescu">
        <meta name="twitter:image" content="{{ asset('assets/img/github.png') }}">
        <meta name="author" content="Holger Schatte">
        
        <meta property="og:title" content="Zahnarzt Dr. Sebastian Fotescu | Zahnarztpraxis in Dresden" />
        <meta property="og:description" content="Herzlich willkommen bei Zahnarztpraxis Dr. Fotescu in Dresden | Ihr Zahnarzt für nette, kompetente und profesionelle Zahnmedizin | Zahnheilkunde auf dem höhsten Niveau." />
        <meta property="og:image" content="{{ asset('assets/img/github.png') }}" />
        <meta property="og:url" content="https://www.meinzahnarztdresden.de" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Zahnarztpraxis Dr. Sebastian Fotescu" />
        <meta property="og:locale" content="de_DE" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-32x32.ico') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-16x16.ico') }}" sizes="16x16">
        <link rel="apple-touch-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/apple-touch-icon-180x180.png') }}">
        <link rel="android-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/android-icon-192x192.png') }}">

        <link rel="alternate" hreflang="de-DE" href="{{ 'https://www.meinzahnarztdresden.de' . $active_link }}" />
        <link rel="alternate" hreflang="x-default" href="{{ 'https://www.meinzahnarztdresden.de' . $active_link }}" />
        <link rel="alternate" hreflang="en-GB" href="{{ 'https://www.meinzahnarztdresden.de/en' . $active_link }}" />
        <link rel="alternate" hreflang="ru-RU" href="{{ 'https://www.meinzahnarztdresden.de/ru' . $active_link }}" />

        @yield('link')

        @yield('title')
        
        @vite('resources/assets/css/app.css')

        @vite('resources/assets/js/app.js')
        
    </head>

    <body>
        <x-navbar :active="$active_link" />

        <main>
            @if(session('message'))
                <x-modal :message="session('message')" :status="session('status')" />
            @endif

            @yield('content')
        </main>

        <x-footer :content="$active_link" />
    </body>
</html>
