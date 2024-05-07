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
              <input class="form-check-input" type="checkbox" role="switch" id="public" {{ $post->public ? 'checked' : '' }}>
              <label class="form-check-label" for="public">
                <span 
                  class="post-public {{ $post->public ? 'post-true' : 'post-false' }} position-relative top-0 left-0">
                    {{ $post->public ? '' : 'not ' }}public
                </span>
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
      class="edit-form row"
      data-ranking=""
    >
    @method('PUT')
    @csrf
      <input type="hidden" name="ranking" value="{{ $post->ranking }}">
      <div class="mb-4 mt-lg-3 d-flex">
        <label class="form-label mt-2">Ranking:</label>
        <input type="number" 
          class="form-control border-0 bg-dark text-white shadow-none text-center ms-3"
          style="width: 5rem;" min="1" max="{{ App\Models\Post::all()->count() }}"
          name="new_ranking" id="ranking" value="{{ $post->ranking }}">
      </div>

      <div class="mb-3">
        <label class="form-label d-block">Blog page main image</label>
        @if( $post->image() )
          <img style="max-height:200px;" id="output-img" class="img-fluid" src="{{ url($post->image()->src) }}">
          <input type="hidden" name="old_image" value="{{ $post->image()->src }}">
        @else
          <img id="output-img" class="img-fluid" src="" style="max-height:200px;">
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
        <section class="post-content">
          <button type="button" data-valid="true"
          data-de-id="{{ $deContent[$i]->id ?? 'false' }}"
          data-en-id="{{ $enContent[$i]->id ?? 'false' }}"
          data-ru-id="{{ $ruContent[$i]->id ?? 'false' }}"
          ></button>
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

          <label class="form-label mt-3">Content</label>
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
        </section>
      @endfor

      <div class="mb-5 mt-3">
        <button type="button" class="btn btn-success p-3 add-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
            <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
          </svg> Content
        </button>
      </div>

      <div class="d-flex justify-content-between">
        <div class="mb-4">
          <button type="reset" class="px-5 mt-3 me-2 btn btn-dark">Reset</button>
          <button type="submit" class="px-5 mt-3 btn btn-primary">Update</button>
        </div>
        <div class="mb-4">
          <a id="destroy" href="{{ url("administration/post/delete/$post->id/$post->content_id") }}" class="px-5 mt-3 btn btn-danger">Delete</a>
        </div>
      </div>

    </form>
  </div>
</div>

<script>
  (() => {
    'use strict';
    const LANGUAGES = [
      'de', 
      'en', 
      'ru'
    ];
    const CONFIMMSG = 'Are you sure you want to delete this section (Subtitle and Content)?';
    const DESTROYMSG = 'Are you sure you want to delete this post?';
    const DOM = {};
    const formEl = document.querySelector('.edit-form');
    const pFormEl = document.querySelector('#pForm');
    const inputImgEl = formEl.querySelector('#image');
    const preview = formEl.querySelector('#output-img');
    const inputCBoxEl = document.querySelector('#public');
    const addBtnItem = formEl.querySelectorAll('.add-btn'); 
    const parentAddBtns = addBtnItem[0].parentNode; 
    const fieldNode = document.querySelectorAll('.field');
    const deleteNode = document.querySelectorAll('.post-content > button');
    const userMsg = document.querySelector('#user-msg');
    const userStatus = document.querySelector('#user-status');
    const statusModalEl = document.querySelector('#status-msg');

    const init = () => {
      setRanking();
      inputImgEl.addEventListener('change', showInputImg);
      inputCBoxEl.addEventListener('change', () => pFormEl.submit());
      addBtnItem.forEach((el) => el.addEventListener('click', formAction));
      deleteNode.forEach((btn) => btn.addEventListener('click', deleteContent));
      destroy.addEventListener('click', destroyPost);
    }

    const setAjax = (url, data, method, response) => {
      let params = typeof data == 'string' ? data : Object.keys(data).map((k) => { 
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) 
      }).join('&');

      let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      xhr.open(method, url, true);
      xhr.onreadystatechange = () => {
        if (xhr.readyState > 3) response(xhr.responseText)
      };
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.send(params);

      return xhr;
    };

    const formAction = (e) => {
      const el = e.currentTarget;
      const newFields = buildScaf(el);

      formEl.insertBefore(newFields, parentAddBtns);
    }

    const buildScaf = (el, fType) => {
      const scaf = document.createElement('section');
      const scafBtn = document.createElement('button');

      const scafSlabel = document.createElement('label');
      const scafClabel = document.createElement('label');
      const ranking = ++formEl.dataset.ranking;

      scaf.classList.add('post-content');
      scafSlabel.classList.add('form-label');
      scafClabel.classList.add('form-label', 'mt-3');
      scafSlabel.innerText = 'Subtitle';
      scafClabel.innerText = 'Content';
      scafBtn.type = 'button';

      scaf.append(scafBtn);
      scaf.append(scafSlabel);

      LANGUAGES.forEach((lang) => {
        const newF = buildFields(false, lang, ranking);
        scaf.append(newF);
      });

      scaf.append(scafClabel);

      LANGUAGES.forEach((lang) => {
        const newF = buildFields(true, lang, ranking);
        scaf.append(newF);
      });

      scafBtn.addEventListener('click', deleteContent);

      return scaf;
    }

    const buildFields = (itype, lang, ranking) => {
      const divEl = document.createElement('div');
      const flagEl = document.createElement('span');
      const flagImg = document.createElement('img');
      const iEl = document.createElement(itype ? 'textarea' : 'input');

      divEl.classList.add('input-group', 'pb-3', 'w-100');
      flagEl.classList.add('input-group-text', 'bg-primary-subtle');
      iEl.classList.add('form-control', 'field');

      flagImg.setAttribute('width', '20');
      flagImg.setAttribute('height', '20');
      flagImg.setAttribute('src', `{{ url('uploads/images/countries') }}/${lang}.png`);
      iEl.setAttribute('required', '');
      iEl.setAttribute('minlength', '3');
      iEl.setAttribute('name', `${itype ? 'content' : 'title'}.${lang}.${ranking}.new`);

      if (itype) {
        iEl.setAttribute('cols', '1');
        iEl.setAttribute('rows', '2');
      } else {
        iEl.setAttribute('maxlength', '255');
        iEl.setAttribute('type', 'text');
      }

      divEl.append(flagEl);
      flagEl.append(flagImg);
      divEl.append(iEl);

      return divEl;
    }

    const setRanking = (search = '.new') => {
      DOM.arr = [];
      
      fieldNode.forEach((el) => {
        DOM.en = el.name;

        if (DOM.en.includes(search)) {
          DOM.en = DOM.en.slice(0, DOM.en.length - search.length);
          DOM.arr.push(Number(DOM.en.substring(DOM.en.lastIndexOf('.') + 1)));
        }
      });

      if (! DOM.arr.length) DOM.arr.push(0);
      formEl.dataset.ranking = DOM.arr.sort().reverse()[0];
    }

    const destroyPost = (e) => {
      if (window.confirm(DESTROYMSG)) {
        const data = { '_token' : "{{ csrf_token() }}" };
        const url = `{{ url("administration/post/delete/$post->id/$post->content_id") }}`;
        
        setAjax(url, data, 'GET', (resp) => setUserJSmsg(resp));
      }
    }

    const deleteContent = (e) => {
      const thisEl = e.currentTarget;

      if (window.confirm(CONFIMMSG) && thisEl.dataset.valid !== undefined) {
        const data = { '_token' : "{{ csrf_token() }}" };
        const url = `{{ url('administration/post/delete/content') }}/${thisEl.dataset.deId}/${thisEl.dataset.enId}/${thisEl.dataset.ruId}`;

        setAjax(url, data, 'GET', (resp) => setUserJSmsg(resp));

        --formEl.dataset.ranking;
        thisEl.parentNode.style.display = 'none';
      } else {
        thisEl.parentNode.remove();
      }
    }

    const setUserJSmsg = (resp) => {
      const { state = resp.status, msg = resp.message } = resp;
      
      statusModalEl.classList.add('vis-modal');
      statusModalEl.style.display = 'block';
      userMsg.innerText = msg;
      userStatus.classList.add( state ? 'status-1' : 'status-0' );
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