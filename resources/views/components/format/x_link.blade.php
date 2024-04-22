{{-- h2 section --}}
{{-- h3 --}}
{{-- text sections --}}
{{-- button --}}

@if ( ! is_null($content->url_link) && ! is_null($content->{app()->getLocale()}->first()) )
@php
$page = $pages->find($content->url_link);
$thisContent = $content->{app()->getLocale()}->first();
$hasBreak = str_contains($thisContent->content, '<br>');
@endphp

@if ( ! ( isset($isOverlap) && $isOverlap ) )
  <div class="wrapper">
    <div class="mb-3 py-5">
      <div class="row my-5" {!! $aos::up(0, 300) !!}>
        <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 x-link-col">
@endif

        <h2 class="mb-2 textdark">{{ __('messages.words.main_title') }}</h2>
        <h3  class="mb-3">
          <strong>
            @if ($thisContent->words_name)
              {{ __("messages.words.$thisContent->words_name") }}
            @else
              {{ $thisContent->title }}
            @endif
          </strong>
        </h3>

        @if ($hasBreak)
          @foreach (explode('<br>', $thisContent->content) as $item)
            <p class="{{ $loop->last ? 'mb-5' : 'mb-4' }}">{{ $item }}</p>
          @endforeach
        @else
          <p class="mb-5">{{ $thisContent->content }}</p>
        @endif

        <div>
          <a 
            class="x-btn"
            href="{{ url($page->weblink) }}"
            title="{{ $page->{app()->getLocale()} }}"
          >
            {{ $page->{app()->getLocale()} }}
          </a>
        </div>
        
@if ( ! ( isset($isOverlap) && $isOverlap ) )
        </div>
      </div>
    </div>
  </div>
@endif

@endif