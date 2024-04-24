@php
  $data = $currPage->getSliderData();
  if ($isBlogPost) $data = NULL;
@endphp

<section class="header{{ !is_null($data) ? '' : ' header-no-src' }}">
  @if( $currPage->isSlideshow() && ! $isBlogPost )
    <x-slideshow :images="$data" :aos="$aos" />
  @else
    @if( $data )
      <div class="img-box-header">
        <img 
          class="static-img" 
          src="{{ asset($data->src) }}" 
          alt="{{ method_exists($data, 'getAlt') ? $data->getAlt() : 'example' }}"
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