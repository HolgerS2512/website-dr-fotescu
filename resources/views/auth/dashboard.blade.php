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

    @foreach ($data as $src)

      <div class="col-lg-6 col-xl-4">
        <div class="p-3">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title">Edit {{ $src->title }}</h5>
              <img src="/{{ $src->image }}" class="card-img-top admin-card">
              <a href="{{ route($src->route . '.header') }}" class="btn btn-primary mt-3 w-100">Header</a>
              <a href="{{ route($src->route . '.content') }}" class="btn btn-primary mt-3 w-100">Content</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    
  </div>
</div>
@endsection