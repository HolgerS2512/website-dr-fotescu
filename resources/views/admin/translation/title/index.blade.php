@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit / Update {{ $name }}</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Edit / Update Page {{ $name }}</h1>

  <div style="margin-top: 130px;" class="mb-5 pb-5 row">
    <div>
      <div class="row g-0">
        <div class="p-3 pb-0 border shadow-lg bg-body-tertiary">
          <div class="mb-4">
            <h3>Edit or update page {{ mb_strtolower($name) }}</h3>
            <p>Don't forget to save and pay attention to upper and lower case!</p>
          </div>

          @foreach ($editable as $edit)
          <form
            id="{{ $edit->id }}"
            action="{{ url('/translation/title/update/' . $edit->id) }}" 
            method="GET" 
            class="p-3 pb-0 border shadow-lg bg-body-tertiary"
          >
          @method('PUT')
          @csrf

            <div class="col-12">

              <div class="my-3">
                <label for="" class="form-label">German</label>
                <input 
                  type="text" 
                  class="form-control @error("name") is-invalid @enderror" 
                  name="name" 
                  value="{{ $edit->name }}" 
                  minlength="3" 
                  maxlength="255"
                >
                @error("name")
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label">English</label>
                <input 
                  type="text" 
                  class="form-control @error("en_name") is-invalid @enderror" 
                  name="en_name" 
                  value="{{ $edit->en_name }}" 
                  minlength="3" 
                  maxlength="255"
                >
                @error("en_name")
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Russian</label>
                <input 
                  type="text" 
                  class="form-control @error("ru_name") is-invalid @enderror" 
                  name="ru_name" 
                  value="{{ $edit->ru_name }}" 
                  minlength="3" 
                  maxlength="255"
                >
                @error("ru_name")
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="mb-4">
                <button type="reset" class="mt-3 px-4 me-2 btn btn-danger" style="min-width: 100px">Reset</button>
                <button type="submit" class="mt-3 px-4 btn btn-dark" style="min-width: 100px">Save</button>
              </div>
            </div>
          </form>
          @if ( ! $loop->last )
            <hr class="my-5" style="border-width: 2px;">
          @else
            <div class="mb-5"></div>
          @endif
          @endforeach

        </div>
      </div>
    </div>
  </div>

</div>
@endsection