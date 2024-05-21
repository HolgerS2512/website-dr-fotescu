{{-- two image sections that overlap --}}

@if ( ! is_null($first->image()) && ! empty($second->toArray()) )
  
  <div class="wrapper">
    <div class="my-5 py-5">
      <div class="row">

        <div class="col-xxl-6 order-xxl-1 overlap-box">
          <div class="overlap overlap-size" {!! $aos::left(0, 300) !!}>
            <img loading="lazy" src="{{ url($first->image()->src) }}" alt="{{ $first->image()->getAlt() }}">
          </div>
          <div class="overlap overlap-offset" {!! $aos::left(200, 200) !!}>
            <img loading="lazy" src="{{ url($second->first()->image()->src) }}" alt="{{ $second->first()->image()->getAlt() }}">
          </div>
        </div>

        <div class="col-12 col-sm-11 col-lg-10 col-xxl-6 x-link-col x-overlap my-5 offset-sm-1 offset-lg-2 offset-xxl-0" {!! $aos::right(0, 300) !!}>
          <x-format.x_link 
              :content="$first" 
              :pages="$pages" 
              :aos="$aos" 
              :isOverlap="true"
            />
        </div>
        
      </div>
    </div>
  </div>

@endif