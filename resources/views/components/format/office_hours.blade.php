{{-- office hours section --}}

<div class="wrapper">
  <div class="mb-3 pb-5">
    <div class="row">

      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 address-col">
        @foreach ($content as $row)
          @if ($row->title)
            <div class="mb-4 pb-1 h2" {!! $aos::left() !!}>
              <b>{{ $row->title }}</b>
            </div>
          @endif
        @endforeach

        @for($i=0; $i < $opening->count(); $i++)
          <div {!! $aos::left(200 * $i) !!}>
            <b>{{ __("messages.words.{$opening[$i]->day}") }}</b>
            <p class="mb-3">

              @if ($opening[$i]->open && $opening[$i]->close)
                {{ $opening[$i]->open }} - {{ $opening[$i]->close }}
              @endif

              @if ($opening[$i]->open_2 && $opening[$i]->close_2)
                <span class="mx-1">{{ explode(' ', __('messages.words.opening_hours_additional'))[0] }}</span>
                {{ $opening[$i]->open_2 }} - {{ $opening[$i]->close_2 }}
              @endif

            </p>
          </div>
        @endfor

        <div {!! $aos::left($opening->count() * 200) !!}>
          <p class="mb-3">{{ __('messages.words.opening_hours_additional') }}</p>
        </div>
      </div>
      
    </div>
  </div>
</div>