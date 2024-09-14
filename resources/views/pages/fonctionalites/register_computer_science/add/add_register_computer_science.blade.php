@extends('main.admin_layout')
@section('title')
    Ajouter une inscription en informatique
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajout d'inscription en informatique /</span> nouvelle inscription en informatique</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h4 class="card-header">Nouvelle inscription en informatique</h4>

                    <div class="card-body pt-2 mt-1">
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('dashboard.inscription_computer_science_student_step_two') }}">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-header">
                                                <b class="ms-2 fst-italic">></b>
                                                Étape 1
                                            </h4>
                                        </div>
                                        <div class="card-body mx-5">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-8 col-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control form-control-lg" type="text" id="matricule"
                                                            name="matricule" placeholder="Entrer le matricule" autofocus />
                                                        <label for="matricule">Matricule</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    <i class="mdi mdi-account-search me-2"></i>
                                                    Vérifier
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('dashboard.liste_computer_science_student') }}"
                                    class="btn btn-outline-danger me-2">
                                    Retour
                                </a>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
