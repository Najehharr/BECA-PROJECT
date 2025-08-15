<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <img src="{{ asset('assets/img/logo-beca.png') }}" alt="Logo BECA" class="img-fluid mb-3 d-block mx-auto" style="max-height:95px;">
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">

    @php
   
    $user = Auth::guard('inspecteur')->user() ?? Auth::user();
    @endphp

    {{-- Directeur --}}
     @if($user && $user->role === 'directeur')
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/directeur') ? 'active' : '' }}" href="{{ route('dashboard.directeur') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 45 40">
              <path d="M..." fill="#FFFFFF" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Etat général</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('missions') ? 'active' : '' }}" href="{{ route('missions') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 46 42">
              <path d="M..." fill="#FFFFFF" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Mission en cours</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('rapports') ? 'active' : '' }}" href="{{ url('rapports') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 43 36">
              <path d="M..." fill="#FFFFFF" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Liste demande congé</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('tables') ? 'active' : '' }}" href="{{ url('tables') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 42 42">
              <path d="M..." fill="#FFFFFF" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Demande de congé</span>
        </a>
      </li>
    </ul>
    @endif

    {{-- Coordinateur --}}
    @if($user && $user->role === 'coordinateur')
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/coordinateur/inspecteur') ? 'active' : '' }}" href="{{ route('dashboard.coordinateur.inspecteur') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
              <path d="M2 2h4v4H2V2zm5 0h4v4H7V2zM2 7h4v4H2V7zm5 0h4v4H7V7zM2 12h4v2H2v-2zm5 0h4v2H7v-2z" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Ajouter Inspecteur</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/coordinateur') ? 'active' : '' }}" href="{{ route('dashboard.coordinateur') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
              <path d="M2 2h4v4H2V2zm5 0h4v4H7V2zM2 7h4v4H2V7zm5 0h4v4H7V7zM2 12h4v2H2v-2zm5 0h4v2H7v-2z" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Ajouter Mission</span>
        </a>
      </li>
    </ul>
    @endif

    {{-- Inspecteur --}}
    @if($user && $user->role === 'inspecteur')
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/inspecteur') ? 'active' : '' }}" href="{{ route('dashboard.inspecteur') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
              <path d="M2 2h4v4H2V2zm5 0h4v4H7V2zM2 7h4v4H2V7zm5 0h4v4H7V7zM2 12h4v2H2v-2zm5 0h4v2H7v-2z" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Nouvelle Mission</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/inspecteur/avancement') ? 'active' : '' }}" href="{{ route('dashboard.inspecteur.avancement') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
              <path d="M0 0h1v15h15v1H0V0zm10 10h2V5h-2v5zm-4 0h2V2H6v8zm-4 0h2V7H2v3z" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Avancement de Mission</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/inspecteur/conge') ? 'active' : '' }}" href="{{ route('dashboard.inspecteur.conge') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
              <path d="M0 0h1v15h15v1H0V0zm10 10h2V5h-2v5zm-4 0h2V2H6v8zm-4 0h2V7H2v3z" />
            </svg>
          </div>
          <span class="nav-link-text ms-1">Congé</span>
        </a>
      </li>
    </ul>
    @endif
  </div>
</aside>