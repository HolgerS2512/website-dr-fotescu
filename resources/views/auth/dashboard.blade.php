@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Admin Dashboard</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
@php
  $parent = [];
@endphp

<div class='container pt-5'>
  <h1 class="special-admin-header">Dashboard</h1>




  <div class="row mt-5 pt-5">
    <h3>Blog posts</h3>
    <hr>

    @foreach ($posts as $post)  
      <div class="col-lg-6 col-xl-4">
        <div class="p-3 mb-3">
          <div class="card w-100" style="min-height: 220px">
            <div class="card-body position-relative">
              <h5 class="card-title text-truncate">{{ $post->de }}</h5>
              @if ( $post->src === null )
                <div class="d-flex justify-content-center align-items-center" style="height: 150px; border-radius: 6px;">
                  <small style="height: min-content; color: red;">No Image Available</small>         
                </div>
              @else
                <img src="/{{ $post->src ?? '' }}" class="card-img-top admin-card">
              @endif
              <span class="post-public {{ $post->public ? 'post-true' : 'post-false' }}">{{ $post->public ? '' : 'not ' }}public</span>
              <a 
                href="{{ url('administration/post/edit/' . $post->id) }}" 
                class="btn btn-primary mt-3 w-100 text-white"
                >Edit
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <div class="col-lg-6 col-xl-4">
      <div class="p-3 mb-3">
        <div style="width: max-content;">
          <a 
            href="{{ url('administration/post/create') }}" 
            class="btn btn-success w-100 text-white py-3"
          ><svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
            <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
          </svg> Create new post</a>
        </div>
      </div>
    </div>
  </div>


  <div class="row my-5 pt-5">
    <h3>Translation</h3>
    <hr>

    <div class="col-lg-6 col-xl-4">
      <div class="p-3 mb-3">
        <div class="card w-100" style="min-height: 220px">
          <div class="card-body position-relative">
            <h5 class="card-title">Pages title and words</h5>
            <h6 class="mt-3">Total completed : {{ ($percent->words + $percent->title) / 2 }} %</h6>
            <a 
              href="{{ url('administration/translation/title') }}" 
              class="btn mt-3 w-100 text-white
              @if ($percent->title < 100)
              btn-danger
              @else
              btn-success
              @endif"
            >Title | {{ $percent->title }} %
            </a>
            <a 
              href="{{ url('administration/translation/words') }}" 
              class="btn mt-3 w-100 text-white
              @if ($percent->words < 100)
              btn-danger
              @else
              btn-success
              @endif"
            >Words | {{ $percent->words }} %
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-xl-4">
      <div class="p-3 mb-3">
        <div class="card w-100" style="min-height: 220px">
          <div class="card-body position-relative">
            <h5 class="card-title">Page content and lists</h5>
            <h6 class="mt-3">Total completed : {{ ($percent->content + $percent->list) / 2 }} %</h6>
            <a 
              href="{{ url('administration/translation/content') }}" 
              class="btn mt-3 w-100 text-white
              @if ($percent->content < 100)
              btn-danger
              @else
              btn-success
              @endif"
            >
              Content | {{ $percent->content }} %
            </a>
            <a 
              href="{{ url('administration/translation/list') }}" 
              class="btn mt-3 w-100 text-white
              @if ($percent->list < 100)
              btn-danger
              @else
              btn-success
              @endif"
            >
              Content lists | {{ $percent->list }} %
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>

  
  <div class="row my-5 pt-5">
    <h3>Main pages</h3>
    <hr>
    @foreach ($pages as $page)
    @php
      $parent[ $page->id ] = $page->en;
    @endphp
      <div class="col-lg-6 col-xl-4">
        <div class="p-3 mb-3">
          <div class="card w-100" style="min-height: 220px">
            <div class="card-body">
              <h5 class="card-title">{{ $page->en }}</h5>

              @if ( $page->src === null )
                <div class="d-flex justify-content-center align-items-center" style="height: 150px; border-radius: 6px;">
                  <small style="height: min-content; color: red;">No Image Available</small>         
                </div>
              @else
                <img src="/{{ $page->src ?? '' }}" class="card-img-top admin-card">
              @endif

              @if ($page->link === 'imprint' || $page->link === 'privacy')
                <button type="button" disabled class="btn btn-secondary mt-3 w-100">Header</button>
              @else
                <a href="{{ url('/' . 'administration/header/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Header</a>
              @endif

              <a href="{{ url('/' . 'administration/content/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Content</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="row my-5 pt-5">
    <h3>Subpages</h3>
    <hr>
    @foreach ($subpages as $page)
    
      <div class="col-lg-6 col-xl-4">
        <div class="p-3 mb-3">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title">
                {{ $page->en }}
                <br>
                <small class="h6 fw-lighter text-body-tertiary">{{ 'Subpage' . ' : ' . $parent[ $page->page_id ] }}</small>
              </h5>
              @if ( $page->src === null )
                <div class="d-flex justify-content-center align-items-center" style="height: 150px; border-radius: 6px;">
                  <small style="height: min-content; color: red;">No Image Available</small>  
                </div>
              @else
                <img src="/{{ $page->src ?? '' }}" class="card-img-top admin-card">
              @endif

              @if ($page->link === 'imprint' || $page->link === 'privacy')
                <button type="button" disabled class="btn btn-secondary mt-3 w-100">Header</button>
              @else
                <a href="{{ url('/' . 'administration/header/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Header</a>
              @endif

              <a href="{{ url('/' . 'administration/content/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Content</a>
            </div>
          </div>
        </div>
      </div>
      
    @endforeach

  </div>

</div>
@endsection