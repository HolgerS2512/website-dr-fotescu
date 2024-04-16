{{-- simple text section --}}

@foreach ($content as $attr)
<div class="wrapper">
  <div class="mb-3 py-5">
    <div class="row">
      <div class="col-lg-2">
        <div class="mb-3 textblack" {!! $aos::right() !!}>
          <b>{{ mb_strtoupper($attr->title) }}</b>
        </div>
      </div>
      
      <div class="col-lg-10" style="max-width: 1175px;">
        <p {!! $aos::up() !!}>{{ $attr->content }}</p>
      </div>
    </div>
  </div>
</div>
@endforeach