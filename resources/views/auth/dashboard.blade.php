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
            <th scope="col" width="20" class="text-center">ID</th>
            <th scope="col" width="200" class="text-center">Image</th>
            <th scope="col" width="120" class="text-center">Title</th>
            <th scope="col" width="120" class="text-center">Created at</th>
            <th scope="col" width="120" class="text-center">Updated at</th>
            <th scope="col" width="120" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @php $i = 1 @endphp
          @foreach ($src as $slider)
          @php $alt = str_replace(' ', '-', strtolower($slider->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden'; @endphp
          <tr>
            <th scope="row">
              <div class="text-center">
                {{ $i++ }}
              </div>
            </th>
            <td>
              <div class="d-flex justify-content-center align-items-center">
                <img width="200" src="{{ $slider->image }}" alt="{{ $alt }}">
              </div>
            </td>
            <td>
              <div class="text-center">
                {{ $slider->title }}
              </div>
            </td>
            <td>
              <div class="text-center">
                {{ $slider->created_at }}
              </div>
            </td>
            <td>
              <div class="text-center">
                {{ $slider->updated_at }}
              </div>
            </td>
            <td>
              <div class="h-100 d-flex justify-content-evenly align-items-center">
                <a href="{{ url('slider/home/edit/' . $slider->id) }}" class="btn btn-warning" title="Edit image">
                  <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" fill="#FFF" /></svg>
                </a>
                <a href="{{ url('slider/home/delete/' . $slider->id) }}" class="btn btn-danger" title="Delete image" onclick="return confirm('Are you sure to delete slider image {{ $slider->title }}?')">
                  <svg xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960" width="35"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" fill="#FFF" /></svg>
                </a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="col-xl-4">
      <div class="row g-0">
        <form 
          action="{{ route('store.home.slider.image') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="p-3 pb-0 border shadow-lg bg-body-tertiary"
        >
          @csrf
          <div class="mb-4">
            <h3>Upload a new image</h3>
            <small class="text-secondary">!!! NOTE:<br>Automatically adds it to the slider on page "home"!</small>
          </div>
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
                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" /></svg> Add image
              </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection