@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Dashboard Administration</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container'>
  <h1 class="special-admin-header">Dashboard</h1>

  <div class="row">

    <div class="col-lg-6 col-xl-4">
      <div class="p-3">
        <div class="card w-100">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <img src="..." class="card-img-top" alt="...">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection