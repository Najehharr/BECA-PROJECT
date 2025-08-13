@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">

            <!-- Titre -->
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard Inspecteur</h1>
                    <h3 class="text-3xl font-bold text-gray-800">Missions assignées</h3>
                </div>

                <!-- Tableau -->
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Inspecteur</th>
                                <th>Status</th>
                                <th>Détails</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($missions as $mission)
                            <tr>
                                <td>{{ $mission->id }}</td>
                                <td>{{ $mission->utilisateurs }}</td>
                                <td>
                                    @if (trim(strtolower($mission->accepte)) === 'en attente')
                                    <span class="badge bg-warning">En attente</span>
                                    @elseif (trim(strtolower($mission->accepte)) === 'accepte')
                                    <span class="badge bg-success">Acceptée</span>
                                    @elseif (trim(strtolower($mission->accepte)) === 'refuse' || trim(strtolower($mission->accepte)) === 'refusée')
                                    <span class="badge bg-danger">Refusée</span>
                                    @else
                                    <span class="badge bg-secondary">Inconnu</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Bouton pour afficher/masquer les détails -->
                                    <button
                                        class="btn btn-info btn-sm toggle-details"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#details{{ $mission->id }}"
                                        aria-expanded="false"
                                        aria-controls="details{{ $mission->id }}">
                                        Voir détails
                                    </button>
                                </td>
                            </tr>

                            <!-- Ligne des détails -->
                            <tr>
                                <td colspan="4" class="p-0 border-0">
                                    <div class="collapse" id="details{{ $mission->id }}">
                                        <div class="card card-body bg-light text-start">
                                            <p><strong>Mission :</strong> {{ $mission->missions }}</p>
                                            <p><strong>Client :</strong> {{ $mission->client }}</p>
                                            <p><strong>Lieu :</strong> {{ $mission->lieu }}</p>
                                            <p><strong>Date début :</strong> {{ $mission->datedebut }}</p>
                                            <p><strong>Date fin :</strong> {{ $mission->datefin }}</p>
                                            <p><strong>Durée :</strong> {{ $mission->duree }}</p>

                                            @if (trim(strtolower($mission->accepte)) === 'en attente')
                                            <div class="mt-2 d-flex gap-2">
                                                <form action="{{ route('missions.accepter', $mission->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Accepter</button>
                                                </form>

                                                <form action="{{ route('missions.refuser', $mission->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                                                </form>
                                            </div>
                                            @endif
                                            <button class="btn btn-secondary btn-sm mt-3">Confirmer</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucune mission assignée pour le moment.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-details').forEach(function (button) {
            const targetId = button.getAttribute('data-bs-target');
            const collapseEl = document.querySelector(targetId);

            if (!collapseEl) return;

            const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: false });

            button.addEventListener('click', function () {
                if (collapseEl.classList.contains('show')) {
                    bsCollapse.hide();
                } else {
                    bsCollapse.show();
                }
            });

            collapseEl.addEventListener('shown.bs.collapse', function () {
                button.textContent = 'Cacher détails';
            });

            collapseEl.addEventListener('hidden.bs.collapse', function () {
                button.textContent = 'Voir détails';
            });
        });
    });
</script>
@endsection
