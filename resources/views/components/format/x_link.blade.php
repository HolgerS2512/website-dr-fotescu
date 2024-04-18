{{-- h2 section --}}
{{-- h3 --}}
{{-- text sections --}}
{{-- button --}}
@php
$page = $pages->find($content->url_link);
$thisContent = $content->{app()->getLocale()}->first();
$hasBreak = str_contains($thisContent->content, '<br>');
@endphp

<div class="wrapper">
  <div class="mb-3 py-5">
    <div class="row my-5" {!! $aos::up(0, 300) !!}>

      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 x-link-col">
        <h2 class="mb-2 textblack">{{ __('messages.words.main_title') }}</h2>
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
            class="{{ $content->btn }}"
            href="{{ url($page->weblink) }}"
            title="{{ $page->{app()->getLocale()} }}"
          >
            {{ $page->{app()->getLocale()} }}
          </a>
        </div>
      </div>
      
    </div>
  </div>
</div>