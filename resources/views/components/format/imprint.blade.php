
<div class="wrapper">
  <div class="mb-3 py-5 mt-5">
    <div class="row">
      <div class="col-lg-8 offset-lg-1">
        <div class="mt-5 pt-5">

          <p class="text-black"><b>{{ __('messages.words.tmgrights') }}</b></p>

          <p>{{ __('messages.words.main_title') }}
            <br>
            {{ $infos->address }}
            <br>
            {{ $infos->zip . ' ' . $infos->city }}
          </p>
          
          <p>
            <a href="{{ $infos->web }}">{{ $infos->web }}</a>
            <br>
            {{ __('messages.words.tel_long') }}:
            <a 
              href="tel:{{ str_replace(' ', '', $infos->phone) }}"
              title="{{ str_replace(' ', '', $infos->phone) }}"
            >
            {{ $infos->phone }}
            </a>
            <br>
            {{ __('messages.words.mail') }}:
            <a 
              href="mailto:{{ $infos->mail }}"
              title="{{ $infos->mail }}"
            >
            {{ $infos->mail }}
            </a>
          </p><br>

          <p class="text-black"><b>{{ __('messages.words.webbuilder') }}</b></p>
          <p><a href="tel:+491748895181">Design & Development made by Holger Schatte</a></p><br>

          @foreach ($content as $row)
            <p class="text-black"><b>{!! $row->title !!}</b></p>
            <p>{!! $row->content !!}</p>
            @if (!$loop->last)
              <br>
            @endif
          @endforeach
  

        </div>
      </div>
    </div>
  </div>
</div>