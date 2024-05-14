<div class="input-group pb-3 w-100{{ isset($last) && $last ? 'border-bottom border-primary' : '' }}">
  <span class="input-group-text bg-primary-subtle">
    @switch($flag)
      @case('de')
        <x-country.de />
        @break
      @case('en')
        <x-country.en />
        @break
      @case('ru')
        <x-country.ru />
        @break
    @endswitch
  </span>
  {{-- <input 
    type="text" 
    class="field form-control @error("{{ $name }}") is-invalid @enderror" 
    name="{{ $name }}" 
    value="{!! preg_replace('/<p>/', "\r\n\n", $value) !!}" 
    maxlength="255"
  > --}}
  <textarea 
  cols="1"
  rows="2"
  class="field form-control @error("{{ $name }}") is-invalid @enderror" 
  name="{{ $name }}" 
  maxlength="255"
>
  {!! preg_replace('/<br>/', "\r\n", $value) !!}
</textarea>
  @error("{{ $name }}")
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>