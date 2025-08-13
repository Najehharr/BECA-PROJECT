@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h1 class="text-3xl font-bold">Dashboard Inspecteur</h1>
                    <h3 class="text-2xl">Suivi des missions</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table table-bordered text-center align-middle">
                        <tbody>
                            @foreach($missions as $mission)
                            @php
                            $duree = max(1, $mission->duree);
                            $progress = round(($mission->jours / $duree) * 100);
                            @endphp

                            <thead class="table-light">
                                <tr>
                                    <th><strong>ID :</strong> {{ $mission->id }}</th>
                                    <th colspan="4">Inspecteur : {{ $mission->utilisateurs }}</th>
                                    <th colspan="3"><strong>Pourcentage global</strong></th>
                                </tr>
                            </thead>

                            <tr>
                                <td>Durée : {{ $mission->duree }} jours</td>
                                <td><strong>Mission</strong><br><hr class="my-1">{{ $mission->missions }}</td>
                                <td>
                                
                                    <form action="{{ route('mission.avancer.jour', $mission->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Avancer</button>
                                    </form>
                                </td>
                                <td><strong>Avancement</strong>
                                    <hr class="my-1">
                                    <small>{{ $mission->jours }} / {{ $mission->duree }} jours</small>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;">
                                            {{ $progress }}%
                                        </div>
                                    </div>
                                </td>
                                <td><strong>Fin mission</strong>
                                    <hr class="my-1"><br>{{ $mission->datefin }}
                                </td>
                                <td>
                                    <strong>Rapport</strong>
                                    <hr class="my-1">
                                    <a href="{{ route('mission.rapport.pdf', $mission->id) }}" class="btn btn-sm btn-secondary" target="_blank">Télécharger PDF</a>
                                </td>
                                <td><strong>Progression</strong><br>{{ $progress }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection