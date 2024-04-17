@php
  $locale = app()->getLocale();
  $title = '';
  $base = '';

  switch ($currPageValues->link) {
    case 'home':
      break;
    case 'blog':
      $title = __('messages.words.page_title_blog');
      break;
    default:
      $title = __("messages.title.$currPageValues->link");
      break;
  }

  $splitArr = explode(' ', (__('messages.words.nav_title')));
  $revArr = array_reverse($splitArr);
  $counter = 1;
  switch ($locale) {
    case 'de':
      $base = $revArr[0] . ' ';
      break;
    case 'en':
      $base = $revArr[1] . ' ' . $revArr[0] . ' ';
      $counter = 2;
      break;
    case 'ru':
      $base = $revArr[1] . ' ' . $revArr[0] . ' ';
      $counter = 2;
      break;
  }

  for($i = 0; $i < count($splitArr) - $counter; $i++) {
    $base .= ($i === 0 ? '' : ' ') . $splitArr[$i];
  }
@endphp
@extends('layouts.app')

{{--------------------> Metadata <--------------------}}
@section('meta')
<meta name="description" content="{{ $currPageValues->link === 'home' ? '' : $title . ' | ' }}{{ __('messages.words.meta_data') }}">
<meta name="keywords" content="{{ __('messages.words.seo_keywords') }}{{ $currPageValues->link === 'home' ? '' : (', ' . str_replace(' ', '-', mb_strtolower($currPageValues->{$locale}))) }}">
@endsection

{{--------------------> Link <--------------------}}
@section('link')
<link href="{{ asset('assets/css/aos.min.css') }}" rel="stylesheet">
@endsection

{{--------------------> Title <--------------------}}
@section('title')
<title>{{ $currPageValues->link === 'home' ? $base : $title . ' | ' . $base }}</title>
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
      :aos="$aos"
    />
  @endisset

  @isset($contentItem)
    {{-- @php
      foreach ($contentItem as $content) {
        dump($content);
        // dump(app()->getLocale());
      }
    @endphp --}}

    {{-- @dd($currPageValues) --}}
    

    @foreach ($contentItem as $content)
      @switch($content->format)
        @case('text')
            <x-format.text :content="$content->{$locale}" :aos="$aos" />
          @break
        @case('buttons')
            <x-format.buttons 
              :list="$content->{$locale . 'List'}" 
              :locale="$locale" 
              :pages="$pages"
              :infos="$infos" 
              :aos="$aos"
            />
          @break
        @case('strip')
            <x-format.strip 
              :list="$content->{$locale . 'List'}" 
              :locale="$locale" 
              :infos="$infos"
              :aos="$aos"
            />
          @break
        @case('cards')
            <x-format.cards 
              :content="$content->{$locale}" 
              :list="$content->{$locale . 'List'}" 
              :infos="$infos"
              :opening="$opening" 
              :aos="$aos"
            />
          @break
        @case('has_subpages')
            <x-format.has_subpages
              :pageId="$currPageValues->id"
              :subpages="$subpages"
              :locale="$locale"  
              :infos="$infos"
              :aos="$aos"
            />
          @break
        @case('headline_list')
            <x-format.headline_list 
              :content="$content->{$locale}" 
              :rang="$content->ranking" 
              :aos="$aos" 
              />
          @break
        @case('headline_text')
            <x-format.headline_text 
              :content="$content->{$locale}" 
              :rang="$content->ranking" 
              :aos="$aos" 
            />
          @break
        @case('two_images_overlap')
            <x-format.two_images_overlap :content="$content->{$locale}" :aos="$aos" />
          @break
        @case('extra_link')
            <x-format.extra_link :content="$content->{$locale}" :aos="$aos" />
          @break
        @case('download')
            <x-format.download :content="$content" :infos="$infos" :aos="$aos" />
          @break
        @case('address')
            <x-format.address 
              :content="$content->{$locale}"
              :rang="$content->ranking" 
              :locale="$locale" 
              :infos="$infos" 
              :aos="$aos" 
            />
          @break
        @case('office_hours')
            <x-format.office_hours
            :content="$content->{$locale}" 
            :locale="$locale" 
            :opening="$opening" 
            :aos="$aos" 
          />
          @break
        @case('cross_list')
            <x-format.cross_list
            :content="$content->{$locale}" 
            :list="$content->{$locale . 'List'}" 
            :locale="$locale" 
            :aos="$aos" 
          />
          @break
        @case('map')
            <x-format.map :content="$content->{$locale}" :locale="$locale" :infos="$infos" :aos="$aos" />
          @break
        @case('headline_image')
            <x-format.headline_image :content="$content->{$locale}" :aos="$aos" />
          @break
        @case('image_small')
            <x-format.image_small :content="$content->{$locale}" :aos="$aos" />
          @break
        @case('subheading')
            <x-format.subheading :list="$content->{$locale . 'List'}" :aos="$aos" />
          @break
        @case('form')
            <x-format.form :content="$content->{$locale}" :aos="$aos" />
          @break
        @case('blog_post')
            <x-format.blog_post :content="$content->{$locale}" :aos="$aos" />
          @break
        @default
      @endswitch
    @endforeach
  @endisset

@endsection

{{--------------------> Script <--------------------}}
{{-- @push('scripts') --}}
{{-- @endpush --}}