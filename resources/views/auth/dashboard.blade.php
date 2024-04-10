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

  <div class="row my-5 pt-5">
    <h3>Translation</h3>
    <hr>

    <div class="col-lg-6 col-xl-4">
      <div class="p-3 mb-3">
        <div class="card w-100" style="min-height: 220px">
          <div class="card-body position-relative">
            <h5 class="card-title">Pages</h5>
            <h6 class="mt-3">Total completed : {{ ($percent->words + $percent->title) / 2 }} %</h6>
            <a 
              href="{{ url('translation/title') }}" 
              class="btn mt-3 w-100 text-white
              @if ($percent->words < 100)
              btn-danger
              @else
              btn-success
              @endif"
            >Title | {{ $percent->words }} %
            </a>
            <a 
              href="{{ url('translation/words') }}" 
              class="btn mt-3 w-100 text-white
              @if ($percent->words < 100)
              btn-danger
              @else
              btn-success
              @endif"
            >Words | {{ $percent->title }} %
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-xl-4">
      <div class="p-3 mb-3">
        <div class="card w-100" style="min-height: 220px">
          <div class="card-body position-relative">
            <h5 class="card-title">Page content</h5>
            <h6 class="mt-3">Already completed : 0 %</h6>
            {{-- <h6 class="mt-3">Total completed : {{ ($percent->words + $percent->title) / 2 }} %</h6> --}}
            <a 
              href="{{ url('translation/title') }}" 
              class="btn mt-5 w-100 text-white
              @if ($percent->words < 100)
              btn-danger
              @else
              btn-success
              @endif"
            >
              Content | 0 %
              {{-- Content | {{ $percent->words }} % --}}
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
      $parent[ $page->id ] = $page->en_name;
    @endphp
    @if ( ! $page->subpage )
      <div class="col-lg-6 col-xl-4">
        <div class="p-3 mb-3">
          <div class="card w-100" style="min-height: 220px">
            <div class="card-body">
              <h5 class="card-title">{{ $page->en_name }}</h5>
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
                <a href="{{ url('/' . 'header/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Header</a>
              @endif

              <a href="{{ url('/' . 'content/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Content</a>
            </div>
          </div>
        </div>
      </div>
    @endif
    @endforeach
  </div>

  <div class="row my-5 pt-5">
    <h3>Subpages</h3>
    <hr>
    @foreach ($pages as $page)
    @if ( $page->subpage )
    
      <div class="col-lg-6 col-xl-4">
        <div class="p-3 mb-3">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title">
                {{ $page->en_name }}
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
                <a href="{{ url('/' . 'header/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Header</a>
              @endif

              <a href="{{ url('/' . 'content/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Content</a>
            </div>
          </div>
        </div>
      </div>
      
    @endif
    @endforeach

  </div>

</div>
@endsection