{{-- simple text section --}}

@foreach ($content as $row)
<div class="wrapper">
  <div class="mb-3 py-5">
    <div class="row">
      <div class="col-lg-2">
        <div class="mb-3 textblack" {!! $aos::right() !!}>
          <b>{{ mb_strtoupper($row->title) }}</b>
        </div>
      </div>
      
      <div class="col-lg-10" style="max-width: 1175px;">
        <p {!! $aos::up() !!}>{{ $row->content }}</p>
      </div>
    </div>
  </div>
</div>
@endforeach