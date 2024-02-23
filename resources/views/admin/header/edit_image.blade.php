@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit Image</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Edit Image</h1>

  <div style="margin-top: 130px;" class="mb-5 pb-5 row">
    <div class="col-md-6">
      <div class="row g-0">
        <form 
          action="{{ url('/' . 'header/' . $page->link . '/image/update/' . $image->id) }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="p-3 pb-0 border shadow-lg bg-body-tertiary"
        >
        @method('PUT')
          @csrf
          <div class="mb-4">
            <h3>Edit</h3>
          </div>
          <div class="mb-3">
            <div class="card p-2 img-box-header">
              <img class="img-fluid" src="{{ asset($image->image) }}">
            </div>
          </div> 
          <div class="mb-3">
            <label for="title" class="form-label">Title*</label>
            <input 
              type="text" 
              class="form-control @error('title') is-invalid @enderror" 
              id="title" 
              name="title" 
              value="{{ $image->title }}" 
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
            >
            <input 
              type="hidden" 
              name="old_image" 
              value="{{ $image->image }}" 
            >
            @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-4">
            <a href="{{ url('/' . 'header/' . $page->link) }}" class="mt-3 px-4 me-2 btn btn-danger">Cancel</a>
            <button type="submit" class="mt-3 px-4 btn btn-dark">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection