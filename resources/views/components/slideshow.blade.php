<div class="swiper">
  <div class="swiper-wrapper">

    @foreach ($images as $image)
      <div class="swiper-slide">
        <div class="img-box-header">
          <img class="slideshow-img" src="{{ asset($image->src) }}" alt="{{ $image->getAlt() }}" {!! $aos::right(100, 0) !!}>
        </div>
      </div>
    @endforeach

  </div>
  <div class="swiper-pagination"></div>
  <div class="swiper-scrollbar"></div>
</div>

<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script>
const swiper = new Swiper('.swiper', {
  effect: 'fade',
  loop: true,
  speed: 800,
  autoplay: {
    delay: 3500,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
  },
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
</script>