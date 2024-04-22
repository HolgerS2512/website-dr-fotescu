@php
  $data = $currPage->getSliderData();
@endphp

<section class="header{{ !is_null($data) ? '' : ' header-no-src' }}">
  @if($currPage->isSlideshow())
    <x-slideshow :images="$data" :aos="$aos" />
  @else
    @if($data)
      <div class="img-box-header">
        <img 
          class="static-img" 
          src="{{ asset($data->src) }}" 
          alt="{{ $data->getAlt() }}"
          {!! $aos::right(100, 0) !!}
        >
      </div>
    @endif
  @endif

  <h1 {!! $aos::left(100) !!}>
    {!! $currPage->getHeadline() !!}
    @if ( ! ( $currPage->link === 'home' || $currPage->link === 'treatments' ) )
      <strong>{{ __('messages.words.h1_subtitle') }}</strong>
    @endif
  </h1>
</section>