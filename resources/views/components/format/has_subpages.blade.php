{{-- Subpage representation cards --}}

<div class="wrapper no-wrapper-768">
  <div class="mb-3 py-5">
    <div class="my-3 py-5">
      <div class="row g-0 row-justify">

@php
  $i = 0;
@endphp

@foreach ($subpages as $sub)

  @php
    $content = null;
    $image = null;

    if ( ! is_null($sub->getSliderData()) ) {
      $image = $sub->isSlideshow() ? $sub->getSliderData()->first() : $sub->getSliderData();
    }

    $fForm = $sub->contents()->get();

    foreach($fForm as $key) {
      $fCon = $key->{$locale}->first();

      if ( ! ( is_null($fCon) && empty($fCon->content) || is_null($fCon->content) ) ) {
        $content = $content ?? $fCon->content;
      }
    }
  @endphp  

  @if ($pageId === $sub->page_id)
    <div class="col-md-6 col-xxl-4 py-2 p-md-2 d-flex justify-content-center mt-5">
      <div class="present-container" {!! $aos::right(300 * $i, 200) !!}>
        <div class="present-aimage">
          <img 
            height="300" width="100%"
            src="{{ url( isset( $image ) ? $image->src : 'uploads/images/examples/example.webp' ) }}" 
            alt="{{ isset( $image ) ? $image->getAlt() : 'example' }}"
          >
        </div>
        <div class="present-box">
          <h2>{{ $sub->{$locale} }}</h2>
          <p>{!! $content !!}</p>
        </div>
        <div class="present-link">
          <a 
            class="x-btn" 
            href="{{ url( $sub->weblink ) }}"
            title="{{ __('messages.words.read') }}"
          >{{ __('messages.words.read') }}</a>
        </div>
      </div>
    </div>

    @php
      $i === 2 ? $i = 0 : $i++;
    @endphp
  @endif

@endforeach
      
      </div>
    </div>
  </div>
</div>