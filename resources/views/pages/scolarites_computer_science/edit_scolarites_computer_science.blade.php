@extends('main.admin_layout')
@section('title')
    Modifier une scolarité d'informatique
@endsection
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier de la scolarité d'informatique</span></h4>
    <div class="row justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card mb-4">
                <h4 class="card-header">Modifier de la scolarité d'informatique</h4>
                <div class="card-body pt-2 mt-1">
                    @if($data)
                        <form id="formAccountSettings" method="POST" action="{{ route('dashboard.update_scolarites_computer_science_request', $data->id) }}">
                            @csrf
                            <div class="row mt-2 justify-content-center">
                                <div class="col-lg-6 col-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="niveau_etude" name="niveau_etude_id" class="select2 form-select">
                                            <option selected value="{{ $data->niveau_etude_id }}">{{ $data->niveau_etude }}</option>
                                            @foreach ($liste_niveau_etude as $item)
                                                <option value="{{ $item->id }}">{{ $item->niveau_etude }}</option>
                                            @endforeach
                                        </select>
                                        <label for="niveau_etude">Selectionnez le niveau d'étude</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                        class="form-control"
                                        type="text"
                                        id="price"
                                        name="price"
                                        value="{{ $data->price }}"
                                        placeholder="Montant total de l'année"
                                        autofocus />
                                        <label for="price">Le montant total de l'année</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                        class="form-control"
                                        type="text"
                                        id="school_year_start"
                                        name="school_year_start"
                                        value="{{ $data->school_year_start }}"
                                        placeholder="2023"
                                        autofocus />
                                        <label for="school_year_start">L'année de commencement des cours</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                        class="form-control"
                                        type="text"
                                        id="school_year_end"
                                        name="school_year_end"
                                        value="{{ $data->school_year_end }}"
                                        placeholder="2024"
                                        autofocus />
                                        <label for="school_year_end">L'année de fin des cours</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-home-plus-outline me-2"></i>
                                    Modifier la scolarité</button>
                                <a role="button" href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    Retour
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection
