@extends('layouts.app')

{{--------------------> Metadata <--------------------}}
@section('meta')
<meta name="description" content="{{ $currPage->getHeader('description') }}">
<meta name="keywords" content="{{ $currPage->getHeader('keywords') }}">
@endsection

{{--------------------> Link <--------------------}}
@section('link')
<link href="{{ asset('assets/css/aos.min.css') }}" rel="stylesheet">
@endsection

{{--------------------> Title <--------------------}}
@section('title')
<title>{{ $currPage->getHeader('title') }}</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')

  <x-header :currPage="$currPage" :isBlogPost="$isBlogPost" :aos="$aos" />

  @isset($contentItem)

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
              :aos="$aos"
            />
          @break
        @case('strip')
            <x-format.strip 
              :list="$content->{$locale . 'List'}" 
              :locale="$locale" 
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
              :pageId="$currPage->id"
              :subpages="$subpages"
              :locale="$locale"  
              :aos="$aos"
            />
          @break
        @case('headline_list')
            <x-format.headline_list 
              :content="$content->{$locale . 'List'}" 
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
        @case('image_overlap')
            <x-format.image_overlap 
              :first="$content" 
              :second="$content->{$locale}" 
              :pages="$pages" 
              :aos="$aos" 
            />
          @break
        @case('x_link')
            <x-format.x_link 
              :content="$content" 
              :pages="$pages" 
              :aos="$aos" 
            />
          @break
        @case('details')
            <x-format.details :content="$content->{$locale}" />
          @break
        @case('download')
            <x-format.download :content="$content" :aos="$aos" />
          @break
        @case('contact_collection')
            <x-format.contact_collection 
              :rang="$content->ranking"
              :form="$currPage->hasForm('contact_collection')" 
              :opening="$opening" 
              :infos="$infos" 
              :aos="$aos" 
            />
          @break
        @case('office_hours')
            <x-format.office_hours
            :content="$content->{$locale}" 
            :layout="$content->layout"
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
            <x-format.map 
              :content="$content" 
              :locale="$locale" 
              :infos="$infos" 
              :aos="$aos" 
            />
          @break
        @case('headline_image')
            <x-format.headline_image 
              :rang="$content->ranking" 
              :content="$content" 
              :locale="$locale" 
              :pages="$pages"
              :subpages="$subpages"
              :aos="$aos" 
            />
          @break
        @case('image_solo')
            <x-format.image_solo :content="$content" :aos="$aos" />
          @break
        @case('subheading')
            <x-format.subheading :list="$content->{$locale . 'List'}" :aos="$aos" />
          @break
        @case('blog_posts')
            <x-format.blog_posts :postMap="$content" :locale="$locale" :aos="$aos" />
          @break
        @case('imprint')
            <x-format.imprint 
              :content="$content->{$locale}" 
              :infos="$infos" 
              :locale="$locale" 
              :aos="$aos" 
              :opening="$opening" 
            />
          @break
        @case('policy')
            <x-format.policy 
              :content="$content->{$locale}" 
              :infos="$infos" 
              :locale="$locale" 
              :aos="$aos" 
            />
          @break
        @default
      @endswitch
    @endforeach

  @endisset

@endsection

{{--------------------> Script <--------------------}}
{{-- @push('scripts') --}}
{{-- @endpush --}}