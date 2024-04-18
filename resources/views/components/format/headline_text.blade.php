{{-- normal heading in two lines with text sections --}}

<div class="wrapper">
  <div class="{{ $rang === 1 ? 'my-3 mt-5 pt-5' : 'mb-3' }} pb-5">
    <div class="row">

      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 row">
        @foreach ($content as $row)
          <h2 class="g-sm-0" {!! $aos::right() !!}>
            <b>{!! $row->title !!}</b>
          </h2>

          <div class="offset-md-2 col-md-10 offset-lg-2 col-lg-10 col-xxl-7 g-sm-0">
            <p style="max-width: 1000px" {!! $aos::left(200) !!}>{{ $row->content }}</p>
          </div>
        @endforeach
      </div>
      
    </div>
  </div>
</div>