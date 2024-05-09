@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Create {{ $page->en }} Content Block</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Create {{ $page->en }} Content Block</h1>
  <div style="margin: 130px 0;">
    <div class="p-3 mb-3">
      <div class="card w-100">
        <div class="card-body position-relative">
          <h5 class="mb-4">Create new content block</h5>
          
          <form 
            action="{{ url("administration/content/$page->link/store") }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="row"
          >
          @csrf
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label"></label>
                <select class="form-select" aria-label="format">
                  <option selected>Choose the format</option>
                  @foreach ($format as $item)
                    <option value="{{ $item->blueprint }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label"></label>
                <input class="form-control" type="text">
              </div>
            </div> --}}

          </form>
  
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (() => {
    'use strict'
    const importantAccEl = document.querySelector('#collapseImportant');
    const importBtn = document.querySelector('.important-btn');

    const init = () => {
      checkStorage();
      // importBtn.addEventListener('click', toggleStore);
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