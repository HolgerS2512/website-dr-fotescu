@php
$path = str_replace(config('app.url'), '', str_replace('www.', '', url()->current()));
$path = str_replace(['/de', '/en', '/ru'], '', $path);
$active_link = $path ?: 'home';

$homePath = '/';
if (app()->getLocale() !== 'de') {
    $homePath = config('app.url') . '/' . app()->getLocale();
}
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
        <meta name="twitter:title" content="{{ __('messages.words.nav_title') }}">
        <meta name="twitter:image" content="{{ asset('assets/img/logo.png') }}">
        <meta name="author" content="Holger Schatte">
        
        <meta property="og:title" content="{{ __('messages.words.nav_title') }}" />
        <meta property="og:description" content="{{ __('messages.words.meta_data') }}" />
        <meta property="og:image" content="{{ asset('assets/img/logo.png') }}" />
        <meta property="og:url" content="{{ $infos->web }}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="{{ __('messages.words.nav_title') }}" />
        <meta property="og:locale" content="de_DE" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="manifest" href="{{ asset('assets/manifest.json') }}" />
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-32x32.ico') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-16x16.ico') }}" sizes="16x16">
        <link rel="apple-touch-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/apple-touch-icon-180x180.png') }}">
        <link rel="android-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/android-icon-192x192.png') }}">

        <link rel="alternate" hreflang="x-default" href="{{ url($active_link === 'home' ? '' : $active_link) }}" />
        <link rel="alternate" hreflang="de-DE" href="{{ url($active_link === 'home' ? '' : $active_link) }}" />
        <link rel="alternate" hreflang="en-GB" href="{{ url($active_link === 'home' ? '' : $active_link) }}" />
        <link rel="alternate" hreflang="ru-RU" href="{{ url($active_link === 'home' ? '' : $active_link) }}" />

        @yield('title')
        
        @yield('link')
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/app-ed1a2a37.css') }}"> --}}
        
        
        @vite('resources/assets/css/app.css')
        @vite('resources/assets/js/app.js')
    </head>

    <body>
        <x-navbar 
            :active="$active_link" 
            :path="$homePath" 
            :locale="$locale" 
            :pages="$pages" 
            :subpages="$subpages" 
            :infos="$infos"
        />

        <main>
            @if(session('present'))
                <x-modal :message="session('message')" :status="session('status')" />
            @endif

            @yield('content')
        </main>

        <x-footer 
            :active="$active_link" 
            :path="$homePath" 
            :locale="$locale" 
            :pages="$pages" 
            :subpages="$subpages" 
            :infos="$infos"
        />

        <x-cookie :path="$path" />

<script type="text/javascript" src="{{ asset('assets/js/aos.js') }}"></script>
<script type="text/javascript">
    'use strict';
    let screen = window.screen.width;
    AOS.init({ offset: (screen === null || screen === undefined || screen > 991.998 ? 200 : 100) });
</script>
{{-- <script type="module" src="{{ asset('assets/js/app-c4266921.js') }}"></script> --}}
@stack('scripts')

    </body>
</html>
