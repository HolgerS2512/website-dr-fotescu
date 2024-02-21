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
        <div class="card w-100">
          <div class="card-body position-relative">
            <h5 class="card-title">Pages</h5>
            <a href="" class="btn btn-danger mt-3 w-100">Title | 0%</a>
            <a href="" class="btn btn-danger mt-3 w-100">Words | 0%</a>
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
      $parent[ $page->id ] = $page->name;
    @endphp
    @if ( ! $page->subpage )
      <div class="col-lg-6 col-xl-4">
        <div class="p-3 mb-3">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title">{{ $page->name }}</h5>
              @if ( $page->image === null )
                <div class="d-flex justify-content-center align-items-center" style="height: 150px; border-radius: 6px;">
                  <small style="height: min-content; color: red;">No Image Available</small>         
                </div>
              @else
                <img src="/{{ $page->image ?? '' }}" class="card-img-top admin-card">
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
                {{ $page->name }}
                <br>
                {{-- <small class="text-body-tertiary">Subpage</small> --}}
                <small class="text-body-tertiary">{{ 'Subpage' . ' : ' . $parent[ $page->page_id ] }}</small>
              </h5>
              @if ( $page->image === null )
                <div class="d-flex justify-content-center align-items-center" style="height: 150px; border-radius: 6px;">
                  <small style="height: min-content; color: red;">No Image Available</small>  
                </div>
              @else
                <img src="/{{ $page->image ?? '' }}" class="card-img-top admin-card">
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