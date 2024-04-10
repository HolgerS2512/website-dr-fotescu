@php
  $locale = app()->getLocale();
@endphp
@extends('layouts.app')

{{--------------------> Metadata <--------------------}}
@section('meta')
<meta name="description" content="Herzlich willkommen bei Zahnarztpraxis Dr. Fotescu in Dresden | Ihr Zahnarzt für nette, kompetente und profesionelle Zahnmedizin | Zahnheilkunde auf dem höhsten Niveau.">
<meta name="keywords" content="zahnarztpraxis, zahnarztpraxis-dresden, zahnarzt, zahnarzt-dresden, zahnarzt-dr-fotescu">
@endsection

{{--------------------> Link <--------------------}}
{{-- @section('link') --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/css/splide.min.css') }}"> --}}
{{-- @endsection --}}

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
      :currPageValues="$currPageValues"
      :infos="$infos"
      :locale="$locale"
    />
  @endisset

  @isset($contentItem)
    {{-- @php
      foreach ($contentItem as $content) {
        dump($content);
        // dump(app()->getLocale());
      }
    @endphp --}}
    

    @foreach ($contentItem as $content)
      @switch($content->format)
        @case('text')
            <x-format.text :content="$content->{$locale}" />
          @break
        @case('buttons')
            <x-format.buttons 
              :list="$content->{$locale . 'List'}" 
              :locale="$locale" 
              :pages="$pages"
              :infos="$infos"
            />
          @break
        @case('cards')
            <x-format.cards 
              :content="$content->{$locale}" 
              :list="$content->{$locale . 'List'}" 
              :infos="$infos"
              :opening="$opening"
            />
          @break
        @case('headline_list')
            <x-format.headline_list :content="$content->{$locale}" />
          @break
        @case('headline_text')
            <x-format.headline_text :content="$content->{$locale}" />
          @break
        @case('two_images_overlap')
            <x-format.two_images_overlap :content="$content->{$locale}" />
          @break
        @case('extra_link')
            <x-format.extra_link :content="$content->{$locale}" />
          @break
        @case('download')
            <x-format.download :content="$content->{$locale}" />
          @break
        @case('address')
            <x-format.address :content="$content->{$locale}" />
          @break
        @case('office_hours')
            <x-format.office_hours :content="$content->{$locale}" />
          @break
        @case('cross_list')
            <x-format.cross_list :content="$content->{$locale}" />
          @break
        @case('map')
            <x-format.map :content="$content->{$locale}" />
          @break
        @case('headline_image')
            <x-format.headline_image :content="$content->{$locale}" />
          @break
        @case('image_small')
            <x-format.image_small :content="$content->{$locale}" />
          @break
        @case('subheading')
            <x-format.subheading :list="$content->{$locale . 'List'}" />
          @break
        @case('form')
            <x-format.form :content="$content->{$locale}" />
          @break
        @case('blog_post')
            <x-format.blog_post :content="$content->{$locale}" />
          @break
        @default
      @endswitch
    @endforeach
  @endisset

@endsection

{{--------------------> Script <--------------------}}
{{-- @push('scripts') --}}
{{-- @endpush --}}