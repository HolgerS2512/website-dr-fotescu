
<div class="wrapper">
  <div class="mb-3 py-5 mt-5">
    <div class="row">
      <div class="col-lg-8 offset-lg-1">
        <div class="mt-5 pt-5">

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
 