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
      <strong>
        {{ __('messages.words.h1_subtitle') }}
      </strong>
    @endif
  </h1>
</section>

<script>
  (() => {
    'use strict'
    const h1El = document.querySelectorAll('.header');
    const subH1El = document.querySelector('h1 > strong') || false;
    const setOpt = window.screen.width <= 767.9998 ? '0%' : '-150px';
    const options = { rootMargin: setOpt };

    const initSubHeading = () => {
      if (subH1El) {
        if (window.screen.width <= 299.9998) {
          subH1El.classList.add('scaling');
        } else {
          
          const elObserver = new IntersectionObserver ((entries, observer) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                subH1El.classList.add('scaling');
              } else {
                subH1El.classList.remove('scaling');
              }
            });
          }, options);
          
          h1El.forEach ((h1El) => elObserver.observe (h1El));
        }
      }
    }

    setTimeout(() => initSubHeading(), 350);
  })()
</script>