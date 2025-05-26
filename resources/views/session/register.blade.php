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

<section class="min-vh-100 mb-8">
  <div class="container">
    <div class="row align-items-center justify-content-center mt-lg-5">

      <div class="col-lg-6 col-md-7">
        <div class="card z-index-0">
          <div class="card-header text-center pt-4">
            <h5>Inscription</h5>
          </div>
          <div class="card-body">
            <form role="form text-left" method="POST" action="/register">
              @csrf
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nom" name="name" id="name" value="{{ old('name') }}">
                @error('name') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                @error('email') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="Mot de passe" name="password" id="password">
                @error('password') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Role" name="role" id="role" value="{{ old('role') }}"> {{-- Changed name and id to 'role' --}}
                @error('role') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
              </div>
              <div class="form-check form-check-info text-left">
                <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                <label class="form-check-label" for="flexCheckDefault">
                J'accepte les <a href="#" class="text-dark font-weight-bolder">Termes et conditions</a>
                </label>
                @error('agreement')
                <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try register again.</p>
                @enderror
              </div>
              <div class="text-center">
                {{-- MODIFICATION HERE: Changed class and added inline style for the button --}}
                <button type="submit" class="btn w-100 my-4 mb-2" style="background-color: #F44336; color: white;">
                  S'inscrire
                </button>
              </div>

              <p class="text-sm mt-3 mb-0">Vous avez déjà un compte ? <a href="login" class="text-dark font-weight-bolder">   Se connecter</a></p>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-5 col-md-5 text-center">
        <img src="{{ asset('assets/img/logo-beca.png') }}" alt="Logo BECA" class="img-fluid" style="max-height: 350px;">
      </div>

    </div>
  </div>
</section>
@endsection