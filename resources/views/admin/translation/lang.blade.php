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
{{-- @dd($row->$de, $enEdit, $ruEdit) --}}
<div class='container py-5'>
  <h1 class="special-admin-header">Edit / Update Page {{ $name }}s</h1>

  <div style="margin-top: 130px;" class="mb-5 pb-5 row">
    <div>
      <div class="row g-0">
        <div class="p-3 pb-0 border shadow-lg bg-body-tertiary">
          <div class="mb-4">
            <h3>Edit or update page {{ mb_strtolower($name) }}s</h3>
            <p class="mb-1">Don't forget to save and pay attention to upper and lower case!</p>
          </div>

          {{-- create relationship functions --}}
          @php 
            foreach ($langs as $lang) {
              ${$lang} = $lang . ($name === 'List' ? 'List' : '');
            }
          @endphp

          @foreach ($contents as $row)
            {{-- continue null relationship --}}
            @php 
              if ( ! (bool) $row->$de->count() 
                && ! (bool) $row->$en->count() 
                && ! (bool) $row->$ru->count() ) continue; 
            @endphp

            @for ($i = 0; $i < $row->$de->count(); $i++)
              {{-- continue special items --}}
              @php if ( $row->$de[$i]->title === 'opening' || $row->$de[$i]->title === 'infos' ) continue; @endphp

              <form
                action="{{ url('administration/translation/' . mb_strtolower($name) .'/'. 'update/content/' . $row->$de[$i]->id .'/'. $row->$en[$i]->id .'/'. $row->$ru[$i]->id) }}"
                method="POST" 
                class="form-item p-3 my-3 pb-0 border shadow-lg bg-body-tertiary"
              >
              @method('PUT')
              @csrf
              <x-helpers.hidden :name="'content_id'" :value="$row->id" />
              <x-helpers.hidden :name="'ranking'" :value="$row->$de[$i]->ranking" />
              <div class="col-12">

                @if ( isset($row->$de[$i]->title) && preg_match('/style="|<headline>/', $row->$de[$i]->title) || isset($row->$de[$i]->content) && preg_match('/style="|<headline>/', $row->$de[$i]->content) )
                <p class="text-danger">For optimal display (if already present in de), please use the following HTML tags in all languages for special objects: <b>&lt;span style="white-space: nowrap;"&gt;&lt;/span&gt; or &lt;headline&gt;</b>.</p>
                @endif

                @if ( isset($row->$de[$i]->title) && ! in_array( $row->$de[$i]->title, ['list'] ) && strlen(trim($row->$de[$i]->title)) > 2 )
                  <h5>Title</h5>
                  <x-helpers.i-group :flag="'de'" :name="$name.'.de.title'" :value="$row->$de[$i]->title ?? ''" />
                  <x-helpers.i-group :flag="'en'" :name="$name.'.en.title'" :value="$row->$en[$i]->title ?? ''" />
                  <x-helpers.i-group :flag="'ru'" :name="$name.'.ru.title'" :value="$row->$ru[$i]->title ?? ''" :last="true" />
                @endif

                @if ( mb_strtolower($name) === 'content' && isset($row->$de[$i]->content) && strlen(trim($row->$de[$i]->content)) > 2 )
                  <h5>Content</h5>
                  <x-helpers.t-group :flag="'de'" :name="$name.'.de.content'" :value="$row->$de[$i]->content ?? ''" />
                  <x-helpers.t-group :flag="'en'" :name="$name.'.en.content'" :value="$row->$en[$i]->content ?? ''" />
                  <x-helpers.t-group :flag="'ru'" :name="$name.'.ru.content'" :value="$row->$ru[$i]->content ?? ''" :last="true" />
                @endif

                @if ( mb_strtolower($name) === 'list' )
                  @for ($idx = 1; $idx <= 20; $idx++)
                    @if ( ! $row->$de[$i]->{'item_' . $idx} ) @break @endif
                    @if ( preg_match('/style="|<headline>/', $row->$de[$i]->{'item_' . $idx}) )
                      <p class="text-danger">For optimal display (if already present in de), please use the following HTML tags in all languages for special objects: <b>&lt;span style="white-space: nowrap;"&gt;&lt;/span&gt; or &lt;headline&gt;</b>.</p>
                    @endif

                    <h5>List item {{ $idx }}</h5>
                    @if (strlen($row->$de[$i]->{'item_' . $idx}) <= 100)
                      <x-helpers.i-group :flag="'de'" :name="$name.'.de.item_'.$idx" :value="$row->$de[$i]->{'item_' . $idx} ?? ''" />
                      <x-helpers.i-group :flag="'en'" :name="$name.'.en.item_'.$idx" :value="$row->$en[$i]->{'item_' . $idx} ?? ''" />
                      <x-helpers.i-group :flag="'ru'" :name="$name.'.ru.item_'.$idx" :value="$row->$ru[$i]->{'item_' . $idx} ?? ''" :last="true" />
                    @else
                      <x-helpers.t-group :flag="'de'" :name="$name.'.de.item_'.$idx" :value="$row->$de[$i]->{'item_' . $idx} ?? ''" />
                      <x-helpers.t-group :flag="'en'" :name="$name.'.en.item_'.$idx" :value="$row->$en[$i]->{'item_' . $idx} ?? ''" />
                      <x-helpers.t-group :flag="'ru'" :name="$name.'.ru.item_'.$idx" :value="$row->$ru[$i]->{'item_' . $idx} ?? ''" :last="true" />
                    @endif
                    
                  @endfor
                @endif

                  <div class="mb-4">
                    <button type="reset" class="mt-3 px-4 me-2 btn btn-danger" style="min-width: 100px">Reset</button>
                    <button type="submit" class="mt-3 px-4 btn btn-dark" style="min-width: 100px">Save</button>
                    <span class="user-message"></span>
                  </div>
                </div>
              </form>
            @endfor
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
      // formItem.forEach((form) => form.addEventListener('submit', setAjax));
    };

    const setAjax = (e) => {
      e.preventDefault();

      const formEl = e.currentTarget;
      const formdata = formEl.querySelectorAll('.form-control');
      const userMsgEl = formEl.querySelector('.user-message');
      const data = {
        '_token' : "{{ csrf_token() }}",
        'content_id' : formEl.querySelector('input[name="content_id"]').value,
        'ranking' : formEl.querySelector('input[name="ranking"]').value,
      };
      const dataCheck = [];

      formdata.forEach((el) => {
        data[el.name] = el.value;
        dataCheck.push(Boolean(el.value));
      });
      
      if (dataCheck.some((b) => b === false)) {
        userMessage(userMsgEl, false);
        return;
      }

      postAjax(formEl.action, data, (resp) => {
        userMessage(userMsgEl, (resp && resp.length < 100) && JSON.parse(resp).status);
      });
      setTimeout(() => location.reload(), 3500);
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
        delay(el, 4, isSuccess);
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