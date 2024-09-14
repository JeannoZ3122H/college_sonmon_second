@extends('main.admin_layout')
@section('title')
    Ajouter un journal de dépense
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Création de journal de dépense /</span> nouveau journal</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h4 class="card-header">Nouveau journal</h4>

                    <div class="card-body pt-2 mt-1">
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('dashboard.add_expense_journal_request') }}">
                            @csrf
                            <div class="row mt-2 gy-4">
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control form-control-lg" type="text" id="designation"
                                            name="designation" placeholder="Entrer la désignation" autofocus />
                                        <label for="designation">Désignation</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="number" min="0" id="qty" name="qty"
                                            placeholder="1" pattern="[0-9]"/>
                                        <label for="qty">Quantité</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="number" min="0" id="unit_price" name="unit_price"
                                            placeholder="0" pattern="[0-9]"/>
                                            <label for="unit_price">Prix unitaire</label>
                                        </div>
                                        <span class="input-group-text fw-bolder">F CFA</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="pc_number" name="pc_number"
                                            placeholder="..."/>
                                        <label for="pc_number">PC N°</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="date" id="date_depense" name="date_depense"
                                            placeholder="..."/>
                                        <label for="date_depense">Date de la dépense</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control" name="observation" placeholder="Entrer ici..." id="observation" style="height: 100px"></textarea>
                                        <label for="observation">Observation</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-home-plus-outline me-2"></i>
                                    Enregistrer
                                </button>
                                <a href="{{ route('dashboard.liste_expense_journal') }}"
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
