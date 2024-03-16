{{-- simple text section --}}

@foreach ($content as $model)
  <p>{{ $model->title }}</p>
  <p>{{ $model->content }}</p>
@endforeach