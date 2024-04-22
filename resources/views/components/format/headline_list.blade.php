{{-- Heading in two lines with list items --}}

<div class="wrapper">
  <div class="{{ $rang === 1 ? 'my-5 pt-5' : 'mb-5' }} pb-5">
    <div class="row">

      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 row">
        @foreach ($content as $row)
          <h2 class="g-sm-0" {!! $aos::right() !!}>
            <b>{!! $row->title !!}</b>
          </h2>

          <div class="offset-md-2 col-md-10 offset-lg-2 col-lg-10 col-xxl-7 g-sm-0 pt-2">
            <ul class="headline-list">
              @for ($i = 1; $i <= 20; $i++)
                @if ( is_null($row->{'item_' . $i}) )
                  @break
                @endif

                <li {!! $aos::left(200 * $i) !!}>
                  @if ( ! is_null($row->image()->src) )
                    <img width="25" height="25" src="{{ url($row->image()->src) }}" alt="">
                  @endif
                  <p>{{ $row->{'item_' . $i} }}</p>
                </li>
              @endfor
            </ul>
          </div>
        @endforeach
      </div>
      
    </div>
  </div>
</div>