@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">

        {{-- Success/Error Alerts --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Add Button --}}
        <div class="mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInspecteurModal">
                <i class="fas fa-plus"></i> Ajouter un Inspecteur
            </button>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0"><h6>Liste des Inspecteurs</h6></div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Mission</th>
                                        <th>Email</th>
                                        <th>Mot de passe</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inspecteurs as $inspecteur)
                                    <tr>
                                        <td>{{ $inspecteur->nom }}</td>
                                        <td>{{ $inspecteur->mission }}</td>
                                        <td>{{ $inspecteur->mail }}</td>
                                        <td>{{ $inspecteur->motpasse }}</td>
                                        <td>
                                            {{-- Edit --}}
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editInspecteurModal{{ $inspecteur->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            {{-- Delete --}}
                                            <form action="{{ route('inspecteurs.destroy', $inspecteur->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Supprimer cet inspecteur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editInspecteurModal{{ $inspecteur->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form action="{{ route('inspecteurs.update', $inspecteur->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modifier Inspecteur</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nom</label>
                                                            <input type="text" name="nom" class="form-control" value="{{ $inspecteur->nom }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Mission</label>
                                                            <input type="text" name="mission" class="form-control" value="{{ $inspecteur->mission }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" name="mail" class="form-control" value="{{ $inspecteur->mail }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Mot de passe</label>
                                                            <input type="password" name="motpasse" class="form-control" placeholder="Laisser vide pour ne pas changer">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary">Enregistrer</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Modal --}}
        <div class="modal fade" id="addInspecteurModal" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('inspecteurs.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter Inspecteur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mission</label>
                                <input type="text" name="mission" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="mail" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mot de passe</label>
                                <input type="password" name="motpasse" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
