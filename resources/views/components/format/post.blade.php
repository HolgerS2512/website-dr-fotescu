{{-- current blog post --}}

<div class="wrapper post">
  <div class="py-5">
    <div class="row">
      
      <div class="col-12 col-sm-11 offset-sm-1 my-5 pb-5">
        <h2 class="text-black">
          <strong>{{ $currPost->{$locale} }}</strong>
        </h2>
      </div>

@foreach ($content as $column)

  <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 mb-5 pb-4" style="max-width: 1000px">
    <div class="mb-4">
      <h3>{{ $column->title }}</h3>
    </div>

    <div>
      <p>{{ $column->content }}</p>
    </div>
  </div>

@endforeach
      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 mb-5 pb-5" {!! $aos::left(100, 200) !!}>
        <a 
          class="x-btn" 
          href="{{ url(($locale === 'de' ? '' : $locale . '/') . 'blog') }}"
          title="{{ __('messages.words.back') }}"
        >{{ __('messages.words.back') }}</a>
      </div>
    </div>
  </div>
</div>

<div class="post-img">
  <img 
    height="auto"
    class="img-fluid" 
    src="{{ asset('assets/img/logo-grey.png') }}" 
    alt="{{ 'logo-grey-' . __("messages.words.nav_title") . '-' . $infos->city . '-png' }}"
  >
</div>