<div class="swiper">
  <div class="swiper-wrapper">

    @foreach ($src as $link)
    @php $alt = str_replace(' ', '-', strtolower($link->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden'; @endphp
      <div class="swiper-slide">
        <div class="img_box">
          <img class="img-fluid" src="{{ asset($link->image) }}" alt="{{ $alt }}">
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