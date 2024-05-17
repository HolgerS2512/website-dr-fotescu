<div class="col-12">
  <div class="p-3 mb-3">
    <div class="card w-100 shadow-lg" style="min-height: 220px">
      <div class="card-body position-relative">
        <h5>Block: {{ $content->format }}</h5>
        
        <form 
          action="{{ url("administration/content/$page->link/update/ranking/$content->id") }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="rank-form"
        >
        @method('PATCH')
        @csrf
          <input type="hidden" name="ranking" value="{{ $content->ranking }}">
          <div class="mb-3 mt-lg-3 d-flex">
            <label class="form-label mt-2">Ranking:</label>
            <input type="number" 
              class="form-control border-0 bg-dark text-white shadow-none text-center ms-3"
              style="width: 5rem;" min="1" max="{{ $count }}" pattern="\d*"
              name="new_ranking" id="ranking" value="{{ $content->ranking }}">
          </div>
        </form>

        @if ($content->format !== 'blog_posts' && $content->format !== 'has_subpages')
          <form
            action="{{ url("administration/content/$page->link/delete/$content->id") }}" 
            method="GET" >
            <button type="submit" class="remove-content"></button>
          </form>
        @endif

        <div class="d-flex justify-content-center align-items-center mb-3 overflow-hidden" style="height: 400px; border-radius: 6px;">
          @if ( is_null($content->getFormatSrc()) )
            <small style="height: min-content; color: red;">No Image Available</small>         
          @else
            <img src="{{ url($content->getFormatSrc()) }}" class="object-fit-cover" style="object-position: center;" width="100%" height="auto">
          @endif
        </div>
        
        {{-- <div class="d-flex justify-content-center align-items-center mb-3 overflow-hidden" style="height: 400px; border-radius: 6px;">
          <iframe width="100%" height="400" src="{{ url("$page->weblink/#$content->format-$content->id") }}"></iframe>
        </div> --}}

          <a 
            href="{{ url("administration/content/$page->link/edit/$content->id") }}" 
            class="btn btn-primary text-white submit-edit" style="padding: .5rem 4.1rem"
            data-format="{{ $content->format }}"
            >Edit
          </a>


      </div>
    </div>
  </div>
</div>