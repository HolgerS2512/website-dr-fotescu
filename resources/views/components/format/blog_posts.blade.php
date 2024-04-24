{{-- blog posts --}}

<div class="wrapper no-wrapper-768">
  <div class="mb-3 py-5">
    <div class="row g-0 blog-justify">

@foreach ($postMap->publicPosts() as $post)

  <div class="col-md-6 col-xxl-4 py-2 p-md-2 d-flex justify-content-center">
    <div class="present-container">
      <div class="present-aimage">
        <img 
          height="300" width="100%"
          src="{{ url(is_null($post->image()) ? 'uploads/images/posts/example.webp' : $post->image()->src) }}" 
          alt="{{ is_null($post->image()) ? 'example' : $post->image()->getAlt() }}"
        >
      </div>
      <div class="present-box">
        <h2>{{ $post->{$locale} }}</h2>
        <p>{{ $post->content()->{$locale}->first()->content ?? '' }}</p>
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

@endforeach
      
    </div>
  </div>
</div>