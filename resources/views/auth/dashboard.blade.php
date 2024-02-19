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
                <a href="{{ url('/'.'header/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Header</a>
              @endif

              <a href="{{ url('/' . 'content/' . $page->link) }}" class="btn btn-primary mt-3 w-100">Content</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    
  </div>
</div>
@endsection