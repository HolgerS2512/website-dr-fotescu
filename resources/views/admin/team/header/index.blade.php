@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit Practice- & Teampage</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Practice & Team</h1>

  <div style="margin-top: 130px;" class="row">
    <div class="col-12">
      <div class="border shadow-lg p-3 bg-white mb-5">
        <div class="accordion accordion-important" id="accordionImportantNote">
          <div class="accordion-item">
            <div class="accordion-header">
              <button class="accordion-button p-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImportant" aria-expanded="true" aria-controls="collapseImportant">
                <h2 class="d-inline text-warning bg-dark p-1">Important note!</h2>
              </button>
            </div>
            <div id="collapseImportant" class="accordion-collapse collapse show" data-bs-parent="#accordionImportantNote">
              <div class="accordion-body">
                <p>Automatically adds it to slider on page "home" (every language)!</p>
                <a class="link" target="_blank" href="https://compress-or-die.com/webp">Optimize your image here! -> https://compress-or-die.com/webp</a>
                <p class="mt-4">Follow this instructions:</p>
                <ol>
                  <li>Click link</li>
                  <li>Select file</li>
                  <li>Preprocessing -> size -> 2000 x 904</li>
                  <li>Compression -> Lossy -> (min 82 | max 85)</li>
                  <li>Generate optimized image</li>
                  <li>download</li>
                  <li>than can you upload</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="border shadow-lg p-3 bg-white mb-5">
        <h3>Slideshow : <b class="{{ $public ? 'text-success' : 'text-danger' }}">{{ $public ? 'visible' : 'hidden' }}</b></h3>
        <div class="mb-3">
          <form action="/slider/team/visible" method="POST" id="change-slideshow">
            @method('PATCH')
            @csrf
            <input type="radio" class="btn-check" name="slideshow" value="0" id="danger-outlined" autocomplete="off"@if(!$public) checked @endif>
            <label class="btn btn-outline-danger me-2" for="danger-outlined">Hidden</label>
            
            <input type="radio" class="btn-check" name="slideshow" value="1" id="success-outlined" autocomplete="off"@if($public) checked @endif>
            <label class="btn btn-outline-success" for="success-outlined">Visible</label>
          </form>
        </div>
        <p>If slideshow not active, the first photo with ID 1 is automatically selected as the start image.</p>
      </div>
    </div>

    <div class="col-xl-8">
      <table class="table table-striped table-bordered shadow-lg mb-0">
        <thead>
          <tr>
            <th scope="col" width="5%" class="text-center">ID</th>
            <th scope="col" width="10%" class="text-center">Image</th>
            <th scope="col" width="15%" class="text-center">Title</th>
            <th scope="col" width="10%" class="text-center">Created at</th>
            <th scope="col" width="10%" class="text-center">Updated at</th>
            <th scope="col" width="10%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @if ( ! isset($src) && empty($src) )
            <tr>
              <td>
                <p class="text-danger">{{ $err }}</p>
              </td>
              <td>
                <p class="text-danger">{{ $err }}</p>
              </td>
              <td>
                <p class="text-danger">{{ $err }}</p>
              </td>
              <td>
                <p class="text-danger">{{ $err }}</p>
              </td>
              <td>
                <p class="text-danger">{{ $err }}</p>
              </td>
              <td>
                <p class="text-danger">{{ $err }}</p>
              </td>
            </tr>
          @else
          @foreach ($src as $slider)
          @php 
            $alt = str_replace(' ', '-', strtolower($slider->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden'; 
          @endphp
          <tr>
            <th scope="row">
              <div class="text-center d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                {{ $loop->index + 1 }}
              </div>
            </th>
            <td class="position-relative">
              <div class="d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                <img width="200" src="/{{ $slider->image }}" alt="{{ $alt }}">
                <span class="online-screen{{ $public || $loop->index + 1 === 1 ? ' o-screen-green' : ' o-screen-red' }}"></span>
              </div>
            </td>
            <td>
              <div class="text-center d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                {{ $slider->title }}
              </div>
            </td>
            <td>
              <div class="text-center d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                {{ $slider->created_at }}
              </div>
            </td>
            <td>
              <div class="text-center d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                {{ $slider->updated_at }}
              </div>
            </td>
            <td>
              <div class="d-flex justify-content-center">
                <form action="{{ url('/slider/team/update/up/' . $slider->id) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  @if (! $loop->first)
                    <input type="hidden" name="ranking" value="{{ $slider->ranking - 1 }}">
                    <input type="hidden" name="previous_id" value="{{ isset($slideIds[$slider->ranking - 1]) ? $slideIds[$slider->ranking - 1] : 1 }}">
                  @endif
                  <button type="@if ($loop->first) button @else submit @endif" title="Image up" class="btn btn-dark me-2"@if ($loop->first) disabled @endif>
                    <x-icons.up :size="35" :clr="'FFF'" />
                  </button>
                </form>

                <a href="{{ url('/slider/team/edit/' . $slider->id) }}" class="btn btn-warning" title="Edit image">
                  <x-icons.edit :size="35" :clr="'FFF'" />
                </a>
              </div>

              <div class="mt-2 d-flex justify-content-center">
                <form action="{{ url('/slider/team/update/down/' . $slider->id) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  @if (! $loop->last)
                    <input type="hidden" name="ranking" value="{{ $slider->ranking + 1 }}">
                    <input type="hidden" name="next_id" value="{{ isset($slideIds[$slider->ranking + 1]) ? $slideIds[$slider->ranking + 1] : 0 }}">
                  @endif
                  <button type="@if ($loop->last) button @else submit @endif" title="Image down" class="btn btn-dark me-2"@if ($loop->last) disabled @endif>
                    <x-icons.down :size="35" :clr="'FFF'" />
                  </button>
                </form>

                <a href="{{ url('/slider/team/delete/' . $slider->id) }}" class="btn btn-danger" title="Delete image" onclick="return confirm('Are you sure to delete slide : {{ $slider->title }}?')">
                  <x-icons.trash :size="35" :clr="'FFF'" />
                </a>
              </div>
            </td>
          </tr>
          @endforeach
          @endisset
        </tbody>
      </table>
    </div>

    <div class="col-xl-4">
      <div class="row g-0">
        <form 
          action="{{ route('store.team.slide') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="p-3 pb-0 border shadow-lg bg-body-tertiary"
        >
        @csrf

          <div class="mb-4">
            <h3>Upload a new image</h3>
          </div>
        @if (isset($src))
          @if ( ! empty($src) && count($src) < 1 )
            <input 
            type="hidden" 
            name="ranking" 
            value="1" 
            >
          @else
            @foreach ($src as $slider)
              @if ($loop->last)
                <input 
                type="hidden" 
                name="ranking" 
                value="{{ $slider->ranking + 1 }}" 
                >
              @endif
            @endforeach
          @endif
        @endif
          <div class="mb-3">
            <label for="title" class="form-label">Title*</label>
            <input 
              type="text" 
              class="form-control @error('title') is-invalid @enderror" 
              id="title" 
              name="title" 
              value="{{ old('title') }}" 
              required
              minlength="3" 
              maxlength="255"
            >
            @error('title')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>      
          <div class="mb-3">
            <label for="image" class="form-label">Image*</label>
            <input 
              type="file" 
              class="form-control @error('image') is-invalid @enderror" 
              id="image" 
              name="image" 
              value="{{ old('image') }}" 
              required
            >
            @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-4">
              <button type="submit" class="mt-3 btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" /></svg> Add Slide
              </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<script>
  (() => {
    'use strict';
    const visibleFormEl = document.querySelector('#change-slideshow');
    const slideshowItem = document.querySelectorAll(`input[name='slideshow']`);

    const init = () => {
      slideshowItem.forEach(el => el.addEventListener('click', onSubmit));
    }

    const onSubmit = () => visibleFormEl.submit();

    init();
  })()
</script>
<script>
  (() => {
    'use strict'
    const importantAccEl = document.querySelector('#collapseImportant');
    const importBtn = document.querySelector('.important-btn');

    const init = () => {
      checkStorage();
      importBtn.addEventListener('click', toggleStore);
    }

    const checkStorage = () => {
      const impStore = localStorage.getItem("important");

      if (impStore !== null && Boolean(impStore)) {
        importantAccEl.classList.add('close-bar');
      }
    }

    const toggleStore = () => {
      setTimeout(() => {
        if (importantAccEl.classList.contains('show')) {
          localStorage.setItem("important", 1);
        } else {
          localStorage.removeItem("important");
        }
      }, 500);
    }

    init();
  })()
</script>
@endsection