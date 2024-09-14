@extends('main.admin_layout')
@section('title')
Détails de mouvement bancaire
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Détails de mouvement bancaire</span></h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    @if($infos)
                    <h4 class="card-header pb-2 text-uppercase" style="text-shadow: .4px 1.3px gray">Mouvement bancaire du {{ $infos->movement_bank_date }}</h4>
                        <div class="card-body pt-2 mt-1">
                            <div class="row justify-content-center">
                                <div class="col-lg-11 col-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">#Id:</b>
                                            <span class="">{{ $infos->id }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Libellé:</b>
                                            <span class="">{{ $infos->movement_bank_libelle }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Banque:</b>
                                            <span class="">{{ $infos->bank }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Versement en banque:</b>
                                            <span class="">{{ $infos->versement_bank }} <b class="text-danger">F CFA</b></span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Alimentation de la caisse par la banque:</b>
                                            <span class="">{{ $infos->alimentation_box_by_bank==null?'Aucun':$infos->alimentation_box_by_bank }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Solde:</b>
                                            <span class="">{{ $infos->balances }} <b class="text-danger">F CFA</b></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item text-end">
                                            <b class="me-2 fst-italic">Enrégistré le :</b>
                                            <span class="text-danger">
                                                <i class="fa fa-calendar-plus fa-1x me-1"></i>
                                                {{ $infos->created_at }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-12 text-start p-2 mb-lg-0 mb-2">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-danger">
                            <i class="fa fa-reply fa-1x me-2"></i>
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
