{{-- normal heading in two lines with text sections --}}

<div class="wrapper">
  <div class="{{ $rang === 1 ? 'my-5 pt-5' : 'mb-5' }} pb-5">
    <div class="row">

      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 row">
        @foreach ($content as $row)
          <h2 class="g-sm-0" {!! $aos::right() !!}>
            <b>{!! $row->title !!}</b>
          </h2>

          <div class="offset-md-2 col-md-10 offset-lg-2 col-lg-10 col-xxl-7 g-sm-0 pt-2">
            @if (str_contains($row->content, '<p>'))
              @php
                $conItem = explode('<p>', $row->content);
              @endphp
              @foreach ($conItem as $item)
                <p style="max-width: 1000px" {!! $aos::left(200 * $loop->index) !!}>{{ $item }}</p>
              @endforeach
            @else
              <p style="max-width: 1000px" {!! $aos::left(200) !!}>{{ $row->content }}</p>
            @endif
          </div>
        @endforeach
      </div>
      
    </div>
  </div>
</div>