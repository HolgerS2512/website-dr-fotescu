{{-- (directions) google maps section --}}

<div class="wrapper">
  <div class="row">
    <div class="col-12 col-sm-10 col-lg-8 offset-sm-1 offset-lg-2">

      @foreach ($content->{$locale} as $row)
        @if ($row->title)
          <div class="mb-4 pb-1 h5" {!! $aos::left() !!}>
            <b class="textblack">{{ $row->title }}</b>
          </div>
        @endif
      @endforeach

    </div>
  </div>
</div>

<div class="wrapper no-wrapper-576">
  <div class="mb-5 pb-5" {!! $aos::right(200) !!}>
    <div class="row d-block d-sm-flex g-0 g-sm-1 mb-5">
      <div class="col-sm-10 col-lg-8 offset-sm-1 offset-lg-2">
        <iframe
          class="my-1 w-100 mw-100 iframe-map"
          src="{{ $content->url_link ?? $infos->iframe }}" style="border:0;" allowfullscreen loading="lazy"
          referrerpolicy="no-referrer-when-downgrade" alt="google-maps-link-{{ __('messages.words.main_title') }}-{{ $infos->city }}" title="Google Maps">
        </iframe>
      </div>
    </div>
  </div>
</div>