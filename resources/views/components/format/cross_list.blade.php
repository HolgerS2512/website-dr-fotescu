{{-- cross list example: find us section --}}
{{-- title (headline) --}}
{{-- text --}}
{{-- bus and tram line (list) --}}

<div class="wrapper">
  <div class="mb-3 pb-5">
    <div class="row">

      <div class="col-12 col-sm-10 col-lg-8 offset-sm-1 offset-lg-2">

        @if ( ! is_null($content) && ! is_null($list->first()) )
        @foreach ($content as $row)
          <div class="mb-4 pb-1 h2" {!! $aos::left() !!}>
            <b>{{ $row->title }}</b>
          </div>
          
          <p {!! $aos::right(200) !!}>{{ $row->content }}</p>
        @endforeach

        @php
          $list = $list->first();
          $max4i = 0;
        @endphp

        <ul class="square-list row pt-3 ps-0">
          @for ($i=1; $i <= 20; $i++)
            @if ( is_null($list['item_' . $i]) ) @break @endif
            @php
              $max4i++;
              if ($max4i > 4) $max4i = 1;
            @endphp
            <div 
              class="col-6 col-sm-3 d-flex justify-content-center align-items-center" 
              {!! $aos::left(200 * $max4i) !!}
            >
              <li>
                <span>{{ $list['item_' . $i] }}</span>
              </li>
            </div>
          @endfor
          @endif
        </ul>

      </div>
      
    </div>
  </div>
</div>