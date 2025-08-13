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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMissionModal">
                <i class="fas fa-plus"></i> Ajouter une mission
            </button>
        </div>

        {{-- Missions Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Liste des inspecteurs</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Mission</th>
                                        <th>Client</th>
                                        <th>Lieu</th>
                                        <th>Inspecteur</th>
                                        <th>Status</th>
                                        <th>Date Début</th>
                                        <th>Date Fin</th>
                                        <th>Durée</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($missions as $mission)
                                    <tr>
                                        <td>{{ $mission->missions }}</td>
                                        <td>{{ $mission->client }}</td>
                                        <td>{{ $mission->lieu }}</td>
                                        <td>{{ $mission->utilisateurs }}</td>
                                        <td>
                                            @if ($mission->status === 'libre')
                                                <span class="badge bg-success">Libre</span>
                                            @elseif ($mission->status === 'en mission')
                                                <span class="badge bg-danger">En mission</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $mission->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $mission->datedebut }}</td>
                                        <td>{{ $mission->datefin }}</td>
                                        <td>{{ $mission->duree }}</td>
                                        <td>
                                            <!-- Edit button -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMissionModal{{ $mission->id }}" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete form -->
                                            <form action="{{ route('missions.destroy', $mission->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editMissionModal{{ $mission->id }}" tabindex="-1" aria-labelledby="editMissionLabel{{ $mission->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('missions.update', $mission->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editMissionLabel{{ $mission->id }}">Modifier Mission</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="missions{{ $mission->id }}" class="form-label">Mission</label>
                                                            <select class="form-select" name="missions" id="missions{{ $mission->id }}" required>
                                                                <option value="Appareil sous pression" {{ $mission->missions == 'Appareil sous pression' ? 'selected' : '' }}>Appareil sous pression</option>
                                                                <option value="Electrique" {{ $mission->missions == 'Electrique' ? 'selected' : '' }}>Electrique</option>
                                                                <option value="Levage" {{ $mission->missions == 'Levage' ? 'selected' : '' }}>Levage</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="client{{ $mission->id }}" class="form-label">Client</label>
                                                            <input type="text" class="form-control" name="client" id="client{{ $mission->id }}" value="{{ $mission->client }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="lieu{{ $mission->id }}" class="form-label">Lieu</label>
                                                            <input type="text" class="form-control" name="lieu" id="lieu{{ $mission->id }}" value="{{ $mission->lieu }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="utilisateurs{{ $mission->id }}" class="form-label">Inspecteur</label>
                                                            <input type="text" class="form-control" name="utilisateurs" id="utilisateurs{{ $mission->id }}" value="{{ $mission->utilisateurs }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="status{{ $mission->id }}" class="form-label">Status</label>
                                                            <select class="form-select" name="status" id="status{{ $mission->id }}" required>
                                                                <option value="libre" {{ $mission->status == 'libre' ? 'selected' : '' }}>Libre</option>
                                                                <option value="en mission" {{ $mission->status == 'en mission' ? 'selected' : '' }}>En mission</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="datedebut{{ $mission->id }}" class="form-label">Date Début</label>
                                                            <input type="date" class="form-control" name="datedebut" id="datedebut{{ $mission->id }}" value="{{ $mission->datedebut }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="datefin{{ $mission->id }}" class="form-label">Date Fin</label>
                                                            <input type="date" class="form-control" name="datefin" id="datefin{{ $mission->id }}" value="{{ $mission->datefin }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="duree{{ $mission->id }}" class="form-label">Durée</label>
                                                            <input type="text" class="form-control" name="duree" id="duree{{ $mission->id }}" value="{{ $mission->duree }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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

        {{-- Add Mission Modal --}}
        <div class="modal fade" id="addMissionModal" tabindex="-1" aria-labelledby="addMissionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('missions.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMissionLabel">Ajouter une mission</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="missions_add" class="form-label">Mission</label>
                                <select class="form-select" name="missions" id="missions_add" required>
                                    <option value="Appareil sous pression">Appareil sous pression</option>
                                    <option value="Electrique">Electrique</option>
                                    <option value="Levage">Levage</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="client_add" class="form-label">Client</label>
                                <input type="text" class="form-control" name="client" id="client_add" required>
                            </div>

                            <div class="mb-3">
                                <label for="lieu_add" class="form-label">Lieu</label>
                                <input type="text" class="form-control" name="lieu" id="lieu_add" required>
                            </div>

                            <div class="mb-3">
                                <label for="utilisateurs_add" class="form-label">Inspecteur</label>
                                <input type="text" class="form-control" name="utilisateurs" id="utilisateurs_add" required>
                            </div>

                            <div class="mb-3">
                                <label for="status_add" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status_add" required>
                                    <option value="libre">Libre</option>
                                    <option value="en mission">En mission</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="datedebut_add" class="form-label">Date Début</label>
                                <input type="date" class="form-control" name="datedebut" id="datedebut_add" required>
                            </div>

                            <div class="mb-3">
                                <label for="datefin_add" class="form-label">Date Fin</label>
                                <input type="date" class="form-control" name="datefin" id="datefin_add">
                            </div>

                            <div class="mb-3">
                                <label for="duree_add" class="form-label">Durée</label>
                                <input type="text" class="form-control" name="duree" id="duree_add">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Affecter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
