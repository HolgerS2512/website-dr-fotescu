{{-- Colored stripes with keyword-like content.  --}}

<div class="bg-strip">
  <div class="wrapper no-wrapper-768">
    <div class="row row-cols-5 g-0 justify-content-between">

    @foreach ($list as $row)
      
      @for ($i = 0; $i <= 20; $i++)
        @if ( ! is_null($row->{'item_' . $i}) )

        <div class="strip-col strip-c-{{ $i }} col-md strip-clr-{{ $i }} px-0" {!! $aos::left($i * 200) !!}>
          <div class="py-4 text-white d-flex flex-column">
            <div class="align-self-center mb-2">
              @if( ! is_null($row->image()) )
                <img 
                  src="{{ url($row->image()->src) }}" 
                  alt="{{ $row->image()->getAlt() }}"
                  width="60" height="60"
                >
              @endif
            </div>
            @php
              if (str_contains($row->{'item_' . $i}, '<br>')) {
                $strBreak = substr($row->{'item_' . $i}, strpos($row->{'item_' . $i}, '<br>') + 4);
                $str = substr($row->{'item_' . $i}, 0, strpos($row->{'item_' . $i}, '<br>'));
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