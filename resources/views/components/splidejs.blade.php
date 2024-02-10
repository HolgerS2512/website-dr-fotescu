<div class="splide" aria-label="Zahnarzt Dr. Fotescu Slideshow">
  <div class="splide__track">
    <ul class="splide__list">

    @foreach ($src as $link)
    @php $alt = str_replace('assets/img/', '', $link) @endphp
      <li class="splide__slide">
        <div class="img_box">
          <img class="img-fluid" src="{{ asset($link) }}" alt="{{ $alt }}">
        </div>
      </li>
    @endforeach

    </ul>
  </div>

  <div class="splide__progress">
    <div class="splide__progress__bar">
    </div>
  </div>
</div>
<script src="{{ asset('assets/js/splide.min.js') }}"></script>
<script>
var splide = new Splide('.splide', {
  type    : 'loop',
  perPage : 1,
  autoplay: true,
  arrows  : false,
}).mount();
</script>