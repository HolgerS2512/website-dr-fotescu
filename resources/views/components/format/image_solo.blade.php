{{-- simple image (600 x 400) [ right-aligned | center-align | left-aligned ] --}}

@if ( ! is_null($content->image()) )
  <div class="mb-5 pb-5 pt-4">
    <div class="d-flex justify-content-center align-items-center mb-5">
      <img
        width="600" height="400"
        class="img-fluid" loading="lazy"
        src="{{ url( $content->image()->src ) }}" 
        alt="{{ $content->image()->getAlt() }}"
        {!! $aos::up(200, 200) !!}
      >
    </div>
  </div>
@endif