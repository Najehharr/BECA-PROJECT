@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">

        {{-- Success message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Demande de congé</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('conge.store') }}" method="POST">
                    @csrf

                    {{-- Nom de l'inspecteur --}}
                    {{-- Use the inspecteur guard --}}
                    <input type="text" class="form-control" id="nom_inspecteur" name="nom_inspecteur"
                        value="{{ Auth::guard('inspecteur')->user()?->nom }}">

                    <input type="text" class="form-control" id="matricule" name="matricule"
                        value="{{ Auth::guard('inspecteur')->user()?->id }}">


                    {{-- Durée du congé --}}
                    <div class="mb-3">
                        <label for="duree_conge" class="form-label">Durée du congé (jours)</label>
                        <input type="number" class="form-control" id="duree_conge" name="duree_conge" required>
                    </div>

                    {{-- Date de début --}}
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                </form>

            </div>
        </div>

    </div>
</main>
@endsection