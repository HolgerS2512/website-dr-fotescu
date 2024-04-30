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
  <input 
    type="text" 
    class="form-control @error("{{ $name }}") is-invalid @enderror" 
    name="{{ $name }}" 
    value="{{ $value }}" 
    minlength="3" 
    maxlength="255"
    required
  >
  @error("{{ $name }}")
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>