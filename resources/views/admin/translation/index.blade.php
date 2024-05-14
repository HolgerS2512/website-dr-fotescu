@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit / Update {{ $name }}</title>

<style>
  #error,
  #success {
    display: none;
  }
</style>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Edit / Update Page {{ $name }}</h1>

  <div style="margin-top: 130px;" class="mb-5 pb-5 row">
    <div>
      <div class="row g-0">
        <div class="p-3 pb-0 border shadow-lg bg-body-tertiary">
          <div class="mb-4">
            <h3>Edit or update page {{ mb_strtolower($name) }}</h3>
            <p class="mb-1">Don't forget to save and pay attention to upper and lower case!</p>
            <p>Changes will only take effect after the page has been updated.</p>
          </div>

          @if (mb_strtolower($name) === 'title')
            @foreach ($editable_2 as $edit)
            <form
              id="{{ $edit->id }}"
              action="{{ url('administration/translation/' . mb_strtolower($name) .'/'. 'update/subpage/' . $edit->id) }}" 
              method="POST" 
              class="form-item p-3 pb-0 border shadow-lg bg-body-tertiary"
            >
            @method('PUT')
            @csrf
              <div class="col-12">

                @isset($edit->context)
                <div class="text-black bg-info-subtle p-3">
                  <p class="mb-2 text-secondary">Page context / Notice:</p>
                  <p class="mb-0">{{ $edit->context }}</p>
                </div>
                @endisset

                <div class="my-3">
                  <label class="form-label">German</label>
                  <input 
                    type="text" 
                    class="form-control @error("de") is-invalid @enderror" 
                    name="de" 
                    value="{{ $edit->de }}" 
                    minlength="3" 
                    maxlength="255"
                    required
                  >
                  @error("de")
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">English</label>
                  <input 
                    type="text" 
                    class="form-control @error("en") is-invalid @enderror" 
                    name="en" 
                    value="{{ $edit->en }}" 
                    minlength="3" 
                    maxlength="255"
                    required
                  >
                  @error("en")
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Russian</label>
                  <input 
                    type="text" 
                    class="form-control @error("ru") is-invalid @enderror" 
                    name="ru" 
                    value="{{ $edit->ru }}" 
                    minlength="3" 
                    maxlength="255"
                    required
                  >
                  @error("ru")
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-4">
                  <button type="reset" class="mt-3 px-4 me-2 btn btn-danger" style="min-width: 100px">Reset</button>
                  <button type="submit" class="mt-3 px-4 btn btn-dark" style="min-width: 100px">Save</button>
                  <span class="user-message"></span>
                </div>
              
              </div>
            </form>

            <hr class="my-5" style="border-width: 2px;">
            @endforeach
          @endif

          @php $model = mb_strtolower($name) === 'title' ? 'page' : 'word'; @endphp
          @foreach ($editable as $edit)
          <form
            id="{{ $edit->id }}"
            action="{{ url('administration/translation/' . mb_strtolower($name) . "/update/$model/$edit->id") }}" 
            method="POST" 
            class="form-item p-3 pb-0 border shadow-lg bg-body-tertiary"
          >
          @method('PUT')
          @csrf
            <div class="col-12">

              @isset($edit->context)
              <div class="text-black bg-info-subtle p-3">
                <p class="mb-2 text-secondary">Page context / Notice:</p>
                <p class="mb-0">{{ $edit->context }}</p>
              </div>
              @endisset

              <div class="my-3">
                <label class="form-label">German</label>
                <input 
                  type="text" 
                  class="form-control @error("de") is-invalid @enderror" 
                  name="de" 
                  value="{{ $edit->de }}" 
                  minlength="3" 
                  maxlength="255"
                  required
                >
                @error("de")
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">English</label>
                <input 
                  type="text" 
                  class="form-control @error("en") is-invalid @enderror" 
                  name="en" 
                  value="{{ $edit->en }}" 
                  minlength="3" 
                  maxlength="255"
                  required
                >
                @error("en")
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Russian</label>
                <input 
                  type="text" 
                  class="form-control @error("ru") is-invalid @enderror" 
                  name="ru" 
                  value="{{ $edit->ru }}" 
                  minlength="3" 
                  maxlength="255"
                  required
                >
                @error("ru")
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-4">
                <button type="reset" class="mt-3 px-4 me-2 btn btn-danger" style="min-width: 100px">Reset</button>
                <button type="submit" class="mt-3 px-4 btn btn-dark" style="min-width: 100px">Save</button>
                <span class="user-message"></span>
              </div>
            
            </div>
          </form>

          @if ( ! $loop->last )
            <hr class="my-5" style="border-width: 2px;">
          @else
            <div class="mb-5"></div>
          @endif
          @endforeach

        </div>
      </div>
    </div>
  </div>

  <svg id="error" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" fill="#fe0000"></path></svg>

  <svg id="success" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" fill="#0ef046"></path></svg>

</div>

<script defer>
  (() => {
    'use strict'
    const formItem = Array.from(document.querySelectorAll('.form-item'));

    const init = () => {
      formItem.forEach((form) => form.addEventListener('submit', setAjax));
    };

    const setAjax = (e) => {
      const formEl = e.currentTarget;
      const userMsgEl = formEl.querySelector('.user-message');

      postAjax(formEl.action, {
        '_token' : "{{ csrf_token() }}",
        'de' : formEl.querySelector("input[name='de']").value,
        'en' : formEl.querySelector("input[name='en']").value,
        'ru' : formEl.querySelector("input[name='ru']").value,
      }, (resp) => {
        userMessage(userMsgEl, (resp && resp.length < 100) && JSON.parse(resp).status);
      });
      e.preventDefault();
    };

    const postAjax = (url, data, response) => {
      let params = typeof data == 'string' ? data : Object.keys(data).map((k) => { 
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) 
      }).join('&');

      let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      xhr.open('POST', url, true);
      xhr.onreadystatechange = () => {
        if (xhr.readyState > 3) response(xhr.responseText)
      };
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.send(params);

      return xhr;
    };

    const userMessage = (el, isSuccess) => {
      buildIcon(el, isSuccess);
      el.classList.add('response');

      if(el.classList.contains('response')) {
        delay(el, 4, isSuccess)
      };
    };

    const delay = (el, counter, isSuccess) => {
      if (counter === 0) {
        const child = el.querySelector(`#${isSuccess ? 'success' : 'error'}`) || false;

        el.classList.remove('response');
        if (child) el.removeChild(child);
      };
      setTimeout(() => delay(el, --counter, isSuccess), 1000);
    };

    const buildIcon = (el, isSuccess) => {
      const cloneEl = document.querySelector(`#${isSuccess ? 'success' : 'error'}`).cloneNode(true);
      const checkItem = Array.from(el.querySelectorAll('svg'));

      if (checkItem.length === 0) el.appendChild(cloneEl);
    };

    init();
  })()
</script>
@endsection