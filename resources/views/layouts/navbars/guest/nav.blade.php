<!-- Navbar -->

    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mx-auto">
        @if (auth()->user())
            <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ url('dashboard') }}">
                <i class="fa fa-chart-pie opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
                Dashboard
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="{{ url('profile') }}">
                <i class="fa fa-user opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
                Profile
            </a>
            </li>
        @endif
        
      </ul>
      
    </div>
  </div>
</nav>
<!-- End Navbar -->
