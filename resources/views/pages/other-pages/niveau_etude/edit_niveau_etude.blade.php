@extends('main.admin_layout')
@section('title')
Modifier un niveau d'étude
@endsection
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier de niveau d'étude</span></h4>
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card mb-4">
                <h4 class="card-header">Modifier de niveau d'étude</h4>
                <div class="card-body pt-2 mt-1">
                    @if($data)
                        <form id="formAccountSettings" method="POST" action="{{ route('dashboard.update_niveau_etude_request', $data->id) }}">
                            @csrf
                            <div class="row mt-2 justify-content-center">
                                <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input
                                    class="form-control"
                                    type="text"
                                    id="niveau_etude"
                                    value="{{ $data->niveau_etude }}"
                                    name="niveau_etude"
                                    placeholder="Niveau d'étude"
                                    autofocus />
                                    <label for="niveau_etude">Niveau d'étude</label>
                                </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-home-plus-outline me-2 my-2"></i>
                                    Modifier le niveau d'étude
                                </button>
                                <a role="button" href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    Retour
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection
