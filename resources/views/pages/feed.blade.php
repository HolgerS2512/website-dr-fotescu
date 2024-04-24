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

  <div class="feed">
    <x-header 
      :currPage="$currPage" 
      :isBlogPost="$isBlogPost"
      :aos="$aos" 
    />

    @isset($contentItem)

      @foreach ($contentItem as $content)
        @if ($content->url_link === $postUrl)
          <x-format.post 
            :content="$content->{$locale}"
            :currPost="$currPost"
            :locale="$locale" 
            :infos="$infos" 
            :aos="$aos"
          />
        @endif
      @endforeach

    @endisset
  </div>
@endsection

{{--------------------> Script <--------------------}}
{{-- @push('scripts') --}}
{{-- @endpush --}}