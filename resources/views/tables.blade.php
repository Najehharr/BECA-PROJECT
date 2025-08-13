@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid py-4">

    {{-- Success message placeholder --}}
    <div id="alert-message" class="alert alert-success d-none"></div>

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Demandes de congé</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th>Nom d'inspecteur</th>
                    <th>Durée (jours)</th>
                    <th class="text-center">Matricule</th>
                    <th class="text-center">Date début</th>
                    <th class="text-center">Statut</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($conges as $conge)
                  <tr data-id="{{ $conge->id }}">
                    <td>{{ $conge->nom_inspecteur }}</td>
                    <td>{{ $conge->duree_conge }}</td>
                    <td class="text-center">{{ $conge->matricule }}</td>
                    <td class="text-center">{{ $conge->date_debut }}</td>

                    {{-- Status badge --}}
                    <td class="text-center status-cell">
                      @if($conge->statut == 'Approuvé')
                        <span class="badge bg-success">Approuvé</span>
                      @elseif($conge->statut == 'Refusé')
                        <span class="badge bg-danger">Refusé</span>
                      @else
                        <span class="badge bg-warning">En attente</span>
                      @endif
                    </td>

                    {{-- Action buttons --}}
                    <td class="text-center">
                      <form action="{{ route('conges.updateStatus', $conge->id) }}" method="POST" class="status-form" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="statut" value="Approuvé">
                        <button type="submit" class="btn btn-success btn-sm update-status-btn">Accepter</button>
                      </form>

                      <form action="{{ route('conges.updateStatus', $conge->id) }}" method="POST" class="status-form" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="statut" value="Refusé">
                        <button type="submit" class="btn btn-danger btn-sm update-status-btn">Refuser</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
              {{ $conges->links() }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>

{{-- AJAX Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let url = this.action;
            let formData = new FormData(this);
            let statut = formData.get('statut');
            let row = this.closest('tr');
            let statusCell = row.querySelector('.status-cell');

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update badge instantly
                    if (statut === 'Approuvé') {
                        statusCell.innerHTML = '<span class="badge bg-success">Approuvé</span>';
                    } else {
                        statusCell.innerHTML = '<span class="badge bg-danger">Refusé</span>';
                    }

                    // Show success message
                    let alertBox = document.getElementById('alert-message');
                    alertBox.textContent = data.message;
                    alertBox.classList.remove('d-none');

                    // Auto-hide after 3 sec
                    setTimeout(() => {
                        alertBox.classList.add('d-none');
                    }, 3000);
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>
@endsection
