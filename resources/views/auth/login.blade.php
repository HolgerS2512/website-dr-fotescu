@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Login Blog Administration</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<h1 class="special-admin-header">Log in</h1>
<div class='container py-5'>
  <form 
      method="POST" 
      action="{{ route('login') }}"
      class="row g-3 col-lg-6 offset-lg-3 border rounded p-3 pb-4 shadow-lg"
  >
      @csrf
      <h2>
        <b class="text-dark">My account</b>
      </h2>
      <div>
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
          <div class="invalid-feedback">
              @error('email')
                  {{ $message }}
              @enderror
          </div>
      </div>
      <div>
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" required>
          <div class="invalid-feedback">
              @error('password')
                  {{ $message }}
              @enderror
          </div>
      </div>           
      <div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                Keep me logged in
              </label>
          </div>
      </div>
      <div class="py-3">
          <button type="submit" class="btn btn-primary px-5">LOGIN</button>
      </div>
      <div>
        <a class="link-secondary" href="{{ route('password.request') }}">Forgot your password?</a>
      </div>
  </form>
</div>
@endsection