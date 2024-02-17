@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Admin Dashboard</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container pt-5'>
  <h1 class="special-admin-header">Dashboard</h1>

  <div class="row mt-5 pt-5">

    @foreach ($pages as $page)
      <div class="col-lg-6 col-xl-4">
        <div class="p-3">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title">{{ $page->name }}</h5>
              <img src="/{{ $page->image ?? '' }}" class="card-img-top admin-card">
              {{-- <a href="{{ route($page->link . '.header') }}" class="btn btn-primary mt-3 w-100">Header</a> --}}
              {{-- <a href="{{ route($page->link . '.content') }}" class="btn btn-primary mt-3 w-100">Content</a> --}}
            </div>
          </div>
        </div>
      </div>
    @endforeach
    
  </div>
</div>
@endsection