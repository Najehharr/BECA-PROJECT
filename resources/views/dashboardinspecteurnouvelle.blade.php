@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">

            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h1 class="fw-bold">Dashboard Inspecteur</h1>
                    <h3 class="fw-bold">Missions assignées</h3>
                </div>

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
                                    @switch(strtolower(trim($mission->accepte)))
                                    @case('en attente')
                                    <span class="badge bg-warning">En attente</span>
                                    @break
                                    @case('accepte')
                                    <span class="badge bg-success">Acceptée</span>
                                    @break
                                    @case('refuse')
                                    @case('refusée')
                                    <span class="badge bg-danger">Refusée</span>
                                    @break
                                    @default
                                    <span class="badge bg-secondary">Inconnu</span>
                                    @endswitch
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary toggle-details"
                                        data-bs-target="#details-{{ $mission->id }}">
                                        Voir détails
                                    </button>
                                    <div class="collapse mt-2" id="details-{{ $mission->id }}">
                                        <div class="card card-body text-start">
                                            <strong>Mission :</strong> {{ $mission->missions }} <br>
                                            <strong>Client :</strong> {{ $mission->client }} <br>
                                            <strong>Lieu :</strong> {{ $mission->lieu }} <br>
                                            <strong>Durée :</strong> {{ $mission->duree }} jours
                                            <form action="{{ route('missions.confirmer', $mission->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    CONFIRMER
                                                </button>
                                            </form>

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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-details').forEach(function(button) {
            const targetId = button.getAttribute('data-bs-target');
            const collapseEl = document.querySelector(targetId);

            if (!collapseEl) return;

            const bsCollapse = new bootstrap.Collapse(collapseEl, {
                toggle: false
            });

            button.addEventListener('click', function() {
                if (collapseEl.classList.contains('show')) {
                    bsCollapse.hide();
                } else {
                    bsCollapse.show();
                }
            });

            collapseEl.addEventListener('shown.bs.collapse', function() {
                button.textContent = 'Cacher détails';
            });

            collapseEl.addEventListener('hidden.bs.collapse', function() {
                button.textContent = 'Voir détails';
            });
        });
    });
</script>
@endsection