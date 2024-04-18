{{-- Subpage representation cards --}}

<div class="wrapper">
  <div class="mb-3 py-5">
    <div class="row justify-content-between">

      @foreach ($subpages as $sub)
        @if ($pageId === $sub->page_id)
          
          @if ( ! is_null($sub->images()))
            @php
              $image = $sub->images()->where('slide', true)->first();
            @endphp
            @isset($image)
              <img 
                src="{{ $image->src }}" 
                alt="{{ $image->getAlt() }}"
              >
            @endisset
          @endif

          <h2 class="text-black">{{ $sub->{$locale} }}</h2>

          {{-- Content über Beziehungen abfragen und aufrufen --}}
        
        @endif
      @endforeach
      
    </div>
  </div>
</div>