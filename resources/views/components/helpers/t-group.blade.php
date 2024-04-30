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
  <textarea 
    cols="1"
    rows="2"
    class="form-control @error("{{ $name }}") is-invalid @enderror" 
    name="{{ $name }}" 
    minlength="3" 
    required
  >{{ $value }}</textarea>
  @error("{{ $name }}")
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>