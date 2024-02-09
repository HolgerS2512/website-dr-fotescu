<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid d-flex justify-content-around">
    @auth
      <a class="navbar-brand" href="">Welcome {{ Auth::user()->name }}</a>
    @else
      <a class="navbar-brand" href="{{ url('/dashboard') }}">Admin Panel Dr. Fotescu</a>
    @endauth
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white" id="offcanvasDarkNavbarLabel"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
  
      <div class="offcanvas-body">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Homepage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/blog') }}">Blog</a>
          </li>

          <li class="nav-item link-placeholder">
            <a href="" class="nav-link">&nbsp;|&nbsp;</a>
          </li>

          <hr>
          
          @auth
            <li class="nav-item">
              <a class="nav-link{{ $active === '/dashboard' ?  ' active' : '' }}"{!! $active === '/dashboard' ?  ' aria-current="page"' : '' !!} href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
          @endauth

          <li class="nav-item">
            @auth
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            @else
              <a class="nav-link{{ $active === '/login' ?  ' active' : '' }}"{!! $active === '/login' ?  ' aria-current="page"' : '' !!} href="{{ url('/login') }}">Log in</a>
            @endauth
          </li>

        </ul>
      </div>
    </div>
  </div>
</nav>