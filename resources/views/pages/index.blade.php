@extends('layouts.app')

{{--------------------> Metadata <--------------------}}
@section('meta')
<meta name="description" content="Herzlich willkommen bei Zahnarztpraxis Dr. Fotescu in Dresden | Ihr Zahnarzt für nette, kompetente und profesionelle Zahnmedizin | Zahnheilkunde auf dem höhsten Niveau.">
<meta name="keywords" content="zahnarztpraxis, zahnarztpraxis-dresden, zahnarzt, zahnarzt-dresden, zahnarzt-dr-fotescu">
@endsection

{{--------------------> Link <--------------------}}
@section('link')
{{-- <link rel="stylesheet" href="{{ asset('assets/css/splide.min.css') }}"> --}}
@endsection

{{--------------------> Title <--------------------}}
@section('title')
<title>Zahnarztpraxis Dr. Sebastian Fotescu</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')

  @isset($slideSrc, $isSlideshow)
    <x-header 
      :src="$slideSrc" 
      :isSlideshow="$isSlideshow" 
      :title="'Zahnarztpraxis<br/>Dr. Sebastian Fotescu'" 
    />
  @endisset

  @isset($contentItem)
    {{-- @php
      foreach ($contentItem as $content) {
        dump($content);
      }
    @endphp --}}

    @foreach ($contentItem as $content)
      @switch($content->format)
        @case('text')
            <x-format.text :content="$content->{config('app.locale')}" />
          @break
        @case('buttons')
            <x-format.buttons :content="$content->{config('app.locale')}" />
          @break
        @case('cards')
            <x-format.cards :content="$content->{config('app.locale')}" />
          @break
        @case('headline_list')
            <x-format.headline_list :content="$content->{config('app.locale')}" />
          @break
        @case('headline_text')
            <x-format.headline_text :content="$content->{config('app.locale')}" />
          @break
        @case('two_images_overlap')
            <x-format.two_images_overlap :content="$content->{config('app.locale')}" />
          @break
        @case('extra_link')
            <x-format.extra_link :content="$content->{config('app.locale')}" />
          @break
        @case('download')
            <x-format.download :content="$content->{config('app.locale')}" />
          @break
        @case('address')
            <x-format.address :content="$content->{config('app.locale')}" />
          @break
        @case('office_hours')
            <x-format.office_hours :content="$content->{config('app.locale')}" />
          @break
        @case('cross_list')
            <x-format.cross_list :content="$content->{config('app.locale')}" />
          @break
        @case('map')
            <x-format.map :content="$content->{config('app.locale')}" />
          @break
        @case('headline_image')
            <x-format.headline_image :content="$content->{config('app.locale')}" />
          @break
        @case('image_small')
            <x-format.image_small :content="$content->{config('app.locale')}" />
          @break
        @case('subheading')
            <x-format.subheading :content="$content->{config('app.locale')}" />
          @break
        @case('form')
            <x-format.form :content="$content->{config('app.locale')}" />
          @break
        @case('blog_post')
            <x-format.blog_post :content="$content->{config('app.locale')}" />
          @break
        @default
      @endswitch
    @endforeach
  @endisset

<h2>-------------INDEX-------------</h2>
<h2>Eingefügter Inhalt aus HOME</h2>
<h2>lang: {{ app()->getLocale() }}</h2>
<h2>url: {{ config('app.url') }}</h2>
<h2>url current: {{ url()->current() }}</h2>
<hr>
ROUTE -> {{  str_replace(config('app.url') . ':8000', '', url()->current()); }}
<br>
<hr>
@endsection

{{--------------------> Script <--------------------}}
{{-- @push('scripts') --}}
{{-- @endpush --}}