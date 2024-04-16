<div class="swiper">
  <div class="swiper-wrapper">

    @foreach ($src as $link)
      @php
        $alt = $link->title . '-' . __("messages.words.nav_title") . '-' . $infos->city . '-' . $link->ext;
        $alt = preg_replace('/[. ( -)]+/', '-', mb_strtolower($alt));
      @endphp
      <div class="swiper-slide">
        <div class="img-box-header">
          <img class="slideshow-img" src="{{ asset($link->src) }}" alt="{{ $alt }}" {!! $aos::right(100, 0) !!}>
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