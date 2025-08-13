@extends('layouts.user_type.auth')

@section('content')

<div>
   <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Missions Table (Données Réelles)</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Missions</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lieus</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($missions as $mission)
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                         
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $mission->missions }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2">
                         
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $mission->lieu }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">
                          {{ \Carbon\Carbon::parse($mission->date)->format('d M Y') }}
                        </p>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="3" class="text-center text-muted">Aucune mission trouvée.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
