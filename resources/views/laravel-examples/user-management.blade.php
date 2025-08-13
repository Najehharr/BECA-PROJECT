@extends('layouts.user_type.auth')

@section('content')

<div>
    <form action="{{ route('rapports.search') }}" method="GET" class="d-flex align-items-center pe-3">
        <input type="date" name="date" class="form-control form-control-sm me-2" required>
           
        <button type="submit" class="btn btn-sm btn-primary"style="background-color: #F44336;">Rechercher</button>
    </form>
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Rapports</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Date </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($rapports as $rapport)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $rapport->rapports }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $rapport->date }}</p>
                        </td>
                    </tr>
                    @endforeach

                    @if($rapports->isEmpty())
                    <tr>
                        <td colspan="2" class="text-center text-muted py-4">
                            Aucun rapport disponible.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection