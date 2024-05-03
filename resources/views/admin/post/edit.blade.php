@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Blog Post</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')

<div class='container pt-5'>
  <div class="border shadow-lg bg-white my-5 p-3">
    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <h2>Edit blog post</h2>
        </div>
      </div>
    
      <div class="col-6">
        <div class="mb-4 d-lg-flex justify-content-end m-lg-3">
          <form id="pForm" action="{{ url("administration/post/update/visible/$post->id") }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="public" value="{{ ! $post->public ? '1' : '0' }}">
            <div class="form-check form-switch" style="max-width: max-content">
              <input class="form-check-input" type="checkbox" role="switch" id="public">
              <label class="form-check-label" for="public">
                <span class="post-public {{ $post->public ? 'post-true' : 'post-false' }} position-relative top-0 left-0">{{ $post->public ? '' : 'not ' }}public</span>
              </label>
            </div>
          </form>
        </div>
      </div>
    </div>
    <h1 class="special-admin-header">Edit blog post</h1>

    <form 
      action="{{ url("administration/post/update/$post->id/$post->content_id") }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="create-form row"
    >
    @method('PUT')
    @csrf
      <div class="mb-3">
        <label class="form-label d-block">Blog page main image</label>
        @if( $post->image() )
          <img width="400" style="max-height:200px;" id="output-img" class="img-fluid" src="{{ url($post->image()->src) }}">
        @endif
      </div>

      <div class="mb-5">
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

      <div class="mb-5">
        <label class="form-label">Headline</label>
        <x-helpers.i-group :flag="'de'" :name="'de'" :value="old('de') ?? $post->de" />
        <x-helpers.i-group :flag="'en'" :name="'en'" :value="old('en') ?? $post->en" />
        <x-helpers.i-group :flag="'ru'" :name="'ru'" :value="old('ru') ?? $post->ru" />
      </div>

      @for ($i = 0; $i < $deContent->count(); $i++) @php $ranking = $i + 1; @endphp
        <div class="mb-5">
          <label class="form-label">Subtitle</label>
          <x-helpers.i-group :flag="'de'" 
            :name="'title.de.' . (isset($deContent[$i]) ? $deContent[$i]->id : $ranking . '.new')" 
            :value="old('title.de.' . $deContent[$i]->id) ?? $deContent[$i]->title" 
          />

          <x-helpers.i-group :flag="'en'" 
            :name="'title.en.' . (isset($enContent[$i]) ? $enContent[$i]->id : $ranking . '.new')" 
            :value="old('title.en.' . (isset($enContent[$i]) ? $enContent[$i]->id : $ranking . '.new')) ?? ( isset($enContent[$i]) ? $enContent[$i]->title : '' )"
           />

          <x-helpers.i-group :flag="'ru'" 
            :name="'title.ru.' . (isset($ruContent[$i]) ? $ruContent[$i]->id : $ranking . '.new')" 
            :value="old('title.ru.' . (isset($ruContent[$i]) ? $ruContent[$i]->id : $ranking . '.new')) ?? ( isset($ruContent[$i]) ? $ruContent[$i]->title : '' )" 
          />
        </div>

        <div class="mb-5">
          <label class="form-label">Content</label>
          <x-helpers.t-group :flag="'de'" 
            :name="'content.de.' . (isset($deContent[$i]) ? $deContent[$i]->id : $ranking . '.new')" 
            :value="old('content.de.' . $deContent[$i]->id) ?? $deContent[$i]->content" 
          />

          <x-helpers.t-group :flag="'en'" 
            :name="'content.en.' . (isset($enContent[$i]) ? $enContent[$i]->id : $ranking . '.new')" 
            :value="old('content.en.' . (isset($enContent[$i]) ? $enContent[$i]->id : $ranking . '.new')) ?? ( isset($enContent[$i]) ? $enContent[$i]->content : '' )" 
          />

          <x-helpers.t-group :flag="'ru'" 
            :name="'content.ru.' . (isset($ruContent[$i]) ? $ruContent[$i]->id : $ranking . '.new')" 
            :value="old('content.ru.' . (isset($ruContent[$i]) ? $ruContent[$i]->id : $ranking . '.new')) ?? ( isset($ruContent[$i]) ? $ruContent[$i]->content : '' )" 
          />
        </div>
      @endfor

      {{-- Hier js felder --}}

      <div class="mb-5">
        <button data-ftype="subtitle" type="button" class="btn btn-success p-3 me-2 add-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
            <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
          </svg> Subtitle
        </button>

        <button data-ftype="content" type="button" class="btn btn-success p-3 add-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
            <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
          </svg> Content
        </button>
      </div>

      <div class="mb-4">
        <button type="reset" class="px-5 mt-3 me-2 btn btn-danger">Reset</button>
        <button type="submit" class="px-5 mt-3 btn btn-dark">Update</button>
      </div>

    </form>
  </div>
</div>

<script>
  (() => {
    'use strict';
    const formEl = document.querySelector('.create-form');
    const pFormEl = document.querySelector('#pForm');
    const inputImgEl = formEl.querySelector('#image');
    const preview = formEl.querySelector('#output-img');
    const inputCBoxEl = document.querySelector('#public');
    const addBtnItem = formEl.querySelectorAll('.add-btn') 

    const init = () => {
      inputImgEl.addEventListener('change', showInputImg);
      inputCBoxEl.addEventListener('change', () => pFormEl.submit());
      addBtnItem.forEach((el) => el.addEventListener('click', formAction));
    }

    const formAction = (e) => {
      const el = e.currentTarget;
      const fType = el.dataset.ftype;
      console.log(fType)
      // buildFields(el, fType, fType === 'content')
    }

    const buildFields = (el, fType, itype = false) => {
      const obj = {
        //
      };

      if (itype) {
        //
      }

      // return obj;
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