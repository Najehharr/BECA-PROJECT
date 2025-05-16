@extends('layouts.user_type.guest')

@section('content')

<style>
  html,
  body {
    height: 100%;
    overflow: hidden;
    margin: 0;
    padding: 0;
  }
</style>

<main class="main-content mt-0">
  <section>
    <div class="page-header min-vh-100 d-flex align-items-center justify-content-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="card card-plain">
              <div class="card-header pb-0 text-center bg-transparent">
                <img src="{{ asset('assets/img/logo-beca.png') }}" alt="Logo BECA" class="img-fluid mb-3" style="max-height: 170px;">

                <p class="mb-0">Page de Connexion</p>
              </div>
              <div class="card-body">
                <form role="form" method="POST" action="/session">
                  @csrf
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="admin@softui.com" aria-label="Email">
                    @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="secret" aria-label="Password">
                    @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-check form-switch">

                    <div class="row mb-3">
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="role" value="inspecteur" id="inspecteur" checked>
                          <label class="form-check-label" for="inspecteur">Inspecteur</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="role" value="coordinateur" id="coordinateur">
                          <label class="form-check-label" for="coordinateur">Coordinateur</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="role" value="directeur" id="directeur">
                          <label class="form-check-label" for="directeur">Directeur</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="role" value="secretaire" id="secretaire">
                          <label class="form-check-label" for="secretaire">Secretaire</label>
                        </div>
                </form>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Se Connecter</button>
            </div>
            </form>
          </div>
          <div class="card-footer text-center pt-0 px-lg-2 px-1">
            <small class="text-muted">Mot de passe oublié ?
              <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">Réinitialiser ici</a>
            </small>
            <p class="mb-4 text-sm mx-auto">
              Vous n'avez pas de compte ?
              <a href="register" class="text-info text-gradient font-weight-bold">S'inscrire</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
</main>

@endsection