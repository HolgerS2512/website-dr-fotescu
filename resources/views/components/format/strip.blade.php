{{-- Colored stripes with keyword-like content.  --}}

<div class="bg-strip">
  <div class="wrapper no-wrapper-992">
    <div class="row row-cols-5 g-0 justify-content-between">

    @foreach ($list as $model)
      
      @for ($i = 0; $i <= 20; $i++)
        @if ( ! is_null($model->{'item_' . $i}) )

        <div class="strip-col strip-c-{{ $i }} col-md strip-clr-{{ $i }} px-0" {!! $aos::left($i * 200) !!}>
          <div class="py-4 text-white d-flex flex-column">
            <div class="align-self-center mb-2">
              @if( ! is_null($model->image()) )
                <img 
                  src="{{ $model->image()->src }}" 
                  alt="{{ $model->image()->title . '-' . __("messages.words.nav_title") . '-' . $infos->city . '-' . $model->image()->ext }}"
                  width="60" height="60"
                >
              @endif
            </div>
            @php
              if (str_contains($model->{'item_' . $i}, '<br>')) {
                $strBreak = substr($model->{'item_' . $i}, strpos($model->{'item_' . $i}, '<br>') + 4);
                $str = substr($model->{'item_' . $i}, 0, strpos($model->{'item_' . $i}, '<br>'));
              }
            @endphp
              <p class="text-center m-0 strip-font">{{ $str }}
                <br>
                <b>{{ $strBreak }}</b>
              </p>
          </div>
        </div>

        @endif
      @endfor

    @endforeach

    </div>
  </div>
</div>