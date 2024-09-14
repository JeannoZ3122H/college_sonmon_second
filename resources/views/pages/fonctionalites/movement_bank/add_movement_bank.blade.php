@extends('main.admin_layout')
@section('title')
    Ajouter un mouvement bancaire
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Création de mouvement bancaire /</span> nouveau mouvement bancaire</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h4 class="card-header">Nouveau mouvement bancaire</h4>

                    <div class="card-body pt-2 mt-1">
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('dashboard.add_movement_bank_request') }}">
                            @csrf
                            <div class="row mt-2 gy-4">
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control form-control-lg" type="text" id="movement_bank_libelle"
                                            name="movement_bank_libelle" placeholder="Entrer la désignation" autofocus />
                                        <label for="movement_bank_libelle">Libellé</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="number" min="0" id="movement_bank_versement_bank" name="movement_bank_versement_bank"
                                                placeholder="1" pattern="[0-9]"/>
                                            <label for="movement_bank_versement_bank">Versement en banque</label>
                                        </div>
                                        <span class="input-group-text fw-bolder">F CFA</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="movement_bank_bank" name="movement_bank_bank"
                                            placeholder="..."/>
                                        <label for="movement_bank_bank">Banque</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="movement_bank_alimentation_box_by_bank" name="movement_bank_alimentation_box_by_bank"
                                            placeholder="..."/>
                                        <label for="movement_bank_alimentation_box_by_bank">Alimentation de la caisse par la banque</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="date" id="movement_bank_date" name="movement_bank_date"
                                            placeholder="..."/>
                                        <label for="movement_bank_date">Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-home-plus-outline me-2"></i>
                                    Enregistrer
                                </button>
                                <a href="{{ route('dashboard.liste_movement_bank') }}"
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
