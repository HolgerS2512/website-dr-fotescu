@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Blog Post</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')

<div class='container pt-5'>
  <h1 class="special-admin-header">Create a new blog post</h1>
  <form 
    action="{{ url('administration/post/store') }}" 
    method="POST" 
    enctype="multipart/form-data"
    class="border shadow-lg bg-white my-5 p-3 create-form"
  >
  @csrf
    <div class="mb-4">
      <h2>Create a new blog post</h2>
    </div>

    <div class="mb-4">
      <label class="form-label">Title*</label>
      <x-helpers.i-group :flag="'de'" :name="'de'" :value="old('de') ?? ''" />
      <x-helpers.i-group :flag="'en'" :name="'en'" :value="old('en') ?? ''" />
      <x-helpers.i-group :flag="'ru'" :name="'ru'" :value="old('ru') ?? ''" />
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input 
        type="file" 
        class="form-control @error('image') is-invalid @enderror" 
        name="image" 
        id="image"
      >
      @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-4">
      <a href="{{ route('dashboard') }}" class="mt-3 me-2 btn btn-danger">
        Back and discard
      </a>
      <button type="submit" class="mt-3 btn btn-success">
        Save and edit post
      </button>
    </div>

    <img id="output-img" class="img-fluid" src="">

  </form>
</div>

<script>
  (() => {
    'use strict';
    const formEl = document.querySelector('.create-form');
    const inputImgEl = formEl.querySelector('#image');
    const preview = formEl.querySelector('#output-img');

    const init = () => {
      inputImgEl.addEventListener('change', showInputImg);
    }

    const showInputImg = () => {
      const file = inputImgEl.files[0];
      const reader = new FileReader();

      reader.addEventListener('load', () => {
        preview.src = reader.result;
      }, false);

      if (file) reader.readAsDataURL(file);
    }

    init()
  })()
</script>
@endsection