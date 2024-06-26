{{-- subheading section example: home under h1 --}}


@foreach ($list as $row)
<section class="gradient-blue py-4 py-md-5 subh-shadow mb-5">
  <div class="wrapper pt-1">
    <div class="row">
      <div class="offset-md-2 col-md-10 d-flex d-md-block justify-content-center">
        <span>
          <h2 class="text-white lh-1 subh-h2" {!! $aos::up() !!}>
            <strong>{!! $row->title !!}</strong>
          </h2>
          
          @for ($i = 1; $i <= 20; $i++)
              @isset($row->{"item_$i"})
                <p 
                  class="subheading-text h5 lh-1 {{ 'subitem-' . $i }}"
                  {!! $aos::left($i * 200) !!}
                >
                  {{ $row->{"item_$i"} }}
                </p>
              @endempty
          @endfor
        </div>
      </div>
    </div>
  </div>
</section>
@endforeach