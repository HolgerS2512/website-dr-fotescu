@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit {{ $page->name }} Header</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Edit {{ $page->name }} Content</h1>

  <div style="margin-top: 130px;" class="row">

    <div class="col-12">
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
          <tr>
            <th scope="row">
              <div class="text-center d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                {{ $loop->index + 1 }}
              </div>
            </th>
            <td class="position-relative">
              <div class="d-flex justify-content-center align-items-center mh-100" style="min-height: 110px">
                <img width="200" src="/{{ $slider->src }}" alt="{{ $slider->title }}">
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
                <form action="{{ url('/' . 'header/' . $page->link . '/image/update/up/' . $slider->id) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  @if (! $loop->first)
                  <input type="hidden" name="ranking" value="{{ $slider->ranking - 1 }}">
                  <input type="hidden" name="previous_id" value="{{ isset($imageIds[$slider->ranking - 1]) ? $imageIds[$slider->ranking - 1] : 1 }}">
                  @endif
                  <button type="@if ($loop->first) button @else submit @endif" title="Image up" class="btn btn-dark me-2" @if ($loop->first) disabled @endif>
                    <x-icons.up :size="35" :clr="'FFF'" />
                  </button>
                </form>

                <a href="{{ url('/' . 'header/' . $page->link . '/image/edit/' . $slider->id) }}" class="btn btn-warning" title="Edit image">
                  <x-icons.edit :size="35" :clr="'FFF'" />
                </a>
              </div>

              <div class="mt-2 d-flex justify-content-center">
                <form action="{{ url('/' . 'header/' . $page->link . '/image/update/down/' . $slider->id) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  @if (! $loop->last)
                  <input type="hidden" name="ranking" value="{{ $slider->ranking + 1 }}">
                  <input type="hidden" name="next_id" value="{{ isset($imageIds[$slider->ranking + 1]) ? $imageIds[$slider->ranking + 1] : 0 }}">
                  @endif
                  <button type="@if ($loop->last) button @else submit @endif" title="Image down" class="btn btn-dark me-2" @if ($loop->last) disabled @endif>
                    <x-icons.down :size="35" :clr="'FFF'" />
                  </button>
                </form>

                <a href="{{ url('/' . 'header/' . $page->link . '/image/delete/' . $slider->id) }}" class="btn btn-danger" title="Delete image" onclick="return confirm('Are you sure to delete slide : {{ $slider->title }}?')">
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

  </div>

</div>

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