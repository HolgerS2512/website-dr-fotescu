<section class="header">
  @if($public)
    <x-slideshow :src="$src" />
  @elseif (!$public)
    <div class="img-box-header">
      <img 
        class="slideshow-img" 
        src="{{ asset($src[0]->image) }}" 
        alt="{{ str_replace(' ', '-', strtolower($src[0]->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden' }}"
      >
    </div>
  @endif
  
  <h1>{!! $title !!}</h1>
</section>