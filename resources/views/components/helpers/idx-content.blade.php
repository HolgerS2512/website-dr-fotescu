<div class="col-12">
  <div class="p-3 mb-3">
    <div class="card w-100" style="min-height: 220px">
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
              style="width: 5rem;" min="1" max="{{ $count }}"
              name="new_ranking" id="ranking" value="{{ $content->ranking }}">
          </div>
        </form>

        <form
          action="{{ url("administration/content/$page->link/delete/$content->id") }}" 
          method="GET" >
          <button type="submit" class="remove-content"></button>
        </form>

        @if ( is_null($content->src) )
          <div class="d-flex justify-content-center align-items-center" style="height: 300px; border-radius: 6px;">
            <small style="height: min-content; color: red;">No Image Available</small>         
          </div>
        @else
          <img src="/{{ $content->src ?? '' }}" class="card-img-top admin-card">
        @endif

        <a 
          {{-- href="{{ url('administration/post/edit/' . $content->id) }}"  --}}
          class="btn btn-primary text-white" style="padding: .5rem 4.1rem"
          >Edit
        </a>

      </div>
    </div>
  </div>
</div>
