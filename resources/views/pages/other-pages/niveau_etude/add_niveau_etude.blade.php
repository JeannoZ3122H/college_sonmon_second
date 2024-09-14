@extends('main.admin_layout')
@section('title')
Ajouter un niveau d'étude
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajouter un niveau d'étude</span></h4>
        <div class="row justify-content-center">
          <div class="col-md-6 col-12">
            <div class="card mb-4">
              <h4 class="card-header">Ajouter un niveau d'étude</h4>
              <div class="card-body pt-2 mt-1">
                <form id="formAccountSettings" method="POST" action="{{ route('dashboard.add_niveau_etude_request') }}">
                    @csrf
                    <div class="row mt-2 justify-content-center">
                        <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input
                            class="form-control"
                            type="text"
                            id="niveau_etude"
                            name="niveau_etude"
                            placeholder="Niveau d'étude"
                            autofocus />
                            <label for="niveau_etude">Niveau d'étude</label>
                        </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary me-2 my-2">
                            <i class="mdi mdi-content-save-check-outline me-2"></i>
                            Enregistrer le niveau d'étude
                        </button>
                        <a role="button" href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            Retour
                        </a>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
