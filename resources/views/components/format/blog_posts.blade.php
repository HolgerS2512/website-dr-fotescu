{{-- blog posts --}}

<div class="wrapper no-wrapper-768">
  <div class="mb-3 py-5">
    <div class="row g-0 row-justify">

@php
  $i = 0;
@endphp

@foreach ($postMap->publicPosts() as $post)

  <div class="col-md-6 col-xxl-4 py-2 p-md-2 mb-5 d-flex justify-content-center">
    <div class="mb-3 present-container" {!! $aos::right(300 * $i, 200) !!}>
      <div class="present-aimage">
        <img 
          height="300" width="100%"
          src="{{ url(is_null($post->image()) ? 'uploads/images/examples/example.webp' : $post->image()->src) }}" 
          alt="{{ is_null($post->image()) ? 'example' : $post->image()->getAlt() }}"
        >
      </div>
      <div class="present-box">
        <h2>{{ $post->{$locale} }}</h2>

        @php
          $letterCounter = 372;
          $content = $post->content()->{$locale}->first()->content ?? '';

          if (strlen($content) >= $letterCounter) {
            $content = substr($content, 0, $letterCounter);
            $content = substr($content, 0, strripos($content, ' '));
          }
          $content = $content . ' ...';
        @endphp

        <p>{!! $content !!}</p>
      </div>
      <div class="present-link">
        <a 
          class="x-btn" 
          href="{{ url(($locale === 'de' ? '' : $locale . '/') . 'blog/' . $post->getUrl()) }}"
          title="{{ __('messages.words.read') }}"
        >{{ __('messages.words.read') }}</a>
      </div>
    </div>
  </div>

@php
  $i === 2 ? $i = 0 : $i++;
@endphp

@endforeach
      
    </div>
  </div>
</div>