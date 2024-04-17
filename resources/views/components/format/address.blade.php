{{-- Address section --}}

<div class="wrapper">
  <div class="{{ $rang === 1 ? 'my-5 pt-5' : 'mb-3' }} pb-3">
    <div class="row">

      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 address-col">
        @foreach ($content as $model)
          @if ($model->title)
            <div class="mb-4 pb-1 h2" {!! $aos::left() !!}>
              <b>{{ $model->title }}</b>
            </div>
          @endif
        @endforeach

        <div {!! $aos::left(200) !!}>
          <p>{{ __('messages.words.main_title') }}</p>
          <p>{{ $infos->location }}</p>
          <p>{{ $infos->address }}</p>
          <p>{{ $infos->zip . ' ' . $infos->city }}</p>
          <br>
          <p>
            {{ __('messages.words.tel_long') }}:
            <a 
              href="tel:{{ str_replace(' ', '', $infos->phone) }}"
              title="{{ str_replace(' ', '', $infos->phone) }}"
            >
            {{ $infos->phone }}
            </a>
          </p>
          <p>
            {{ __('messages.words.mail') }}:
            <a 
              href="mailto:{{ $infos->mail }}"
              title="{{ $infos->mail }}"
            >
            {{ $infos->mail }}
            </a>
          </p>
        </div>
      </div>
      
    </div>
  </div>
</div>