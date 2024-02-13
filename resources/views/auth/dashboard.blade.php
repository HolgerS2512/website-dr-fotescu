@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Dashboard Blog Administration</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Dashboard</h1>

  <div style="margin-top: 130px;" class="mb-5 pb-5 row">
    <h2 class="col-12">Homepage Slider</h2>

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
          @if ( ! isset($srcHome) && empty($srcHome))
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
          @foreach ($srcHome as $slider)
          @php 
            $alt = str_replace(' ', '-', strtolower($slider->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden'; 
          @endphp
          <tr>
            <th scope="row">
              <div class="text-center d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                {{ $i++ }}
              </div>
            </th>
            <td>
              <div class="d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                <img width="200" src="{{ $slider->image }}" alt="{{ $alt }}">
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
                <form action="{{ url('/slider/home/update/up/' . $slider->id) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  @if (! $loop->first)
                    <input type="hidden" name="ranking" value="{{ $slider->ranking - 1 }}">
                    <input type="hidden" name="previous_id" value="{{ isset($homeSlideIds[$slider->ranking - 1]) ? $homeSlideIds[$slider->ranking - 1] : 1 }}">
                  @endif
                  <button type="@if ($loop->first) button @else submit @endif" title="Image up" class="btn btn-dark me-2"@if ($loop->first) disabled @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="m296-345-56-56 240-240 240 240-56 56-184-184-184 184Z" fill="#FFF" /></svg>
                  </button>
                </form>

                <a href="{{ url('/slider/home/edit/' . $slider->id) }}" class="btn btn-warning" title="Edit image">
                  <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" fill="#FFF" /></svg>
                </a>
              </div>

              <div class="mt-2 d-flex justify-content-center">
                <form action="{{ url('/slider/home/update/down/' . $slider->id) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  @if (! $loop->last)
                    <input type="hidden" name="ranking" value="{{ $slider->ranking + 1 }}">
                    <input type="hidden" name="next_id" value="{{ isset($homeSlideIds[$slider->ranking + 1]) ? $homeSlideIds[$slider->ranking + 1] : 0 }}">
                  @endif
                  <button type="@if ($loop->last) button @else submit @endif" title="Image down" class="btn btn-dark me-2"@if ($loop->last) disabled @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z" fill="#FFF" /></svg>
                  </button>
                </form>

                <a href="{{ url('/slider/home/delete/' . $slider->id) }}" class="btn btn-danger" title="Delete image" onclick="return confirm('Are you sure to delete slide : {{ $slider->title }}?')">
                  <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" fill="#FFF" /></svg>
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
          action="{{ route('store.home.slide') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="p-3 pb-0 border shadow-lg bg-body-tertiary"
        >
          @csrf
          <div class="mb-4">
            <h3>Upload a new image</h3>
            <small class="text-secondary">
              !!! NOTE: !!!
              <br>Automatically adds it to the slider on page "home"!
              <br><a class="link" href="https://compress-or-die.com/webp">Optimize your image!</a>
              <br>Instructions:
              <ol>
                <li>Select file</li>
                <li>Preprocessing -> size -> 2000 x 904</li>
                <li>Compression -> Lossy -> (min 82 | max 85)</li>
                <li>Generate optimized image</li>
                <li>download</li>
              </ol>
            </small>
          </div>
        @if (isset($srcHome))
          @if ( ! empty($srcHome) && count($srcHome) < 1 )
            <input 
            type="hidden" 
            name="ranking" 
            value="1" 
            >
          @else
            @foreach ($srcHome as $slider)
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

  <div style="margin-top: 100px;" class="mb-5 pb-5 row">
    <h2 class="col-12">Praxis- & Teampage Slider</h2>

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
          @if ( ! isset($srcTeam) && empty($srcTeam))
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
          @php $i = 1 @endphp
          @foreach ($srcTeam as $slider)
          @php $alt = str_replace(' ', '-', strtolower($slider->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden'; @endphp
          <tr>
            <th scope="row">
              <div class="text-center d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                {{ $i++ }}
              </div>
            </th>
            <td>
              <div class="d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                <img width="200" src="{{ $slider->image }}" alt="{{ $alt }}">
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
                    <input type="hidden" name="previous_id" value="{{ isset($teamSlideIds[$slider->ranking - 1]) ? $teamSlideIds[$slider->ranking - 1] : 1 }}">
                  @endif
                  <button type="@if ($loop->first) button @else submit @endif" title="Image up" class="btn btn-dark me-2"@if ($loop->first) disabled @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="m296-345-56-56 240-240 240 240-56 56-184-184-184 184Z" fill="#FFF" /></svg>
                  </button>
                </form>

                <a href="{{ url('/slider/team/edit/' . $slider->id) }}" class="btn btn-warning" title="Edit image">
                  <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" fill="#FFF" /></svg>
                </a>
              </div>

              <div class="mt-2 d-flex justify-content-center">
                <form action="{{ url('/slider/team/update/down/' . $slider->id) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  @if (! $loop->last)
                    <input type="hidden" name="ranking" value="{{ $slider->ranking + 1 }}">
                    <input type="hidden" name="next_id" value="{{ isset($teamSlideIds[$slider->ranking + 1]) ? $teamSlideIds[$slider->ranking + 1] : 0 }}">
                  @endif
                  <button type="@if ($loop->last) button @else submit @endif" title="Image down" class="btn btn-dark me-2"@if ($loop->last) disabled @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z" fill="#FFF" /></svg>
                  </button>
                </form>

                <a href="{{ url('/slider/team/delete/' . $slider->id) }}" class="btn btn-danger" title="Delete image" onclick="return confirm('Are you sure to delete slide : {{ $slider->title }}?')">
                  <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" fill="#FFF" /></svg>
                </a>
              </div>
            </td>
          </tr>
          @endforeach
          @endif
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
            <small class="text-secondary">
              !!! NOTE: !!!
              <br>Automatically adds it to the slider on page "team"!
              <br><a class="link" href="https://compress-or-die.com/webp">Optimize your image!</a>
              <br>Instructions:
              <ol>
                <li>Select file</li>
                <li>Preprocessing -> size -> 2000 x 904</li>
                <li>Compression -> Lossy -> (min 82 | max 85)</li>
                <li>Generate optimized image</li>
                <li>download</li>
              </ol>
            </small>
          </div>
        @if (isset($srcTeam))
          @if ( ! empty($srcTeam) && count($srcTeam) < 1 )
            <input 
            type="hidden" 
            name="ranking" 
            value="1" 
            >
          @else
            @foreach ($srcTeam as $slider)
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
@endsection