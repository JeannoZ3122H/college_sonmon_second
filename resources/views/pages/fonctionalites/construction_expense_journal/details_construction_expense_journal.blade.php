@extends('main.admin_layout')
@section('title')
Détails de journal de dépense de constrcution
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Détails de journal de dépense de constrcution</span></h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    @if($infos)
                    <h4 class="card-header pb-2 text-uppercase" style="text-shadow: .4px 1.3px gray">Journal de dépense de constrcution du {{ $infos->construction_date_depense }}</h4>
                        <div class="card-body pt-2 mt-1">
                            <div class="row justify-content-center">
                                <div class="col-lg-11 col-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">#Id:</b>
                                            <span class="">{{ $infos->id }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">PC N°:</b>
                                            <span class="">{{ $infos->construction_pc_number }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">DÉSIGNATION:</b>
                                            <span class="">{{ $infos->construction_designation }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Quantité:</b>
                                            <span class="">x{{ $infos->construction_quantity }}</span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Prix Unitaire:</b>
                                            <span class="">{{ $infos->construction_unit_price }} <b class="text-danger">F CFA</b></span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Montant:</b>
                                            <span class="">{{ $infos->construction_montant_designation }} <b class="text-danger">F CFA</b></span>
                                        </li>
                                        <li class="list-group-item pb-1">
                                            <b class="me-2 text-uppercase">Cumul:</b>
                                            <span class="">{{ $infos->construction_cumul_montant_designation }} <b class="text-danger">F CFA</b></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b class="me-2 text-uppercase">Observation:</b>
                                            <div class="card">
                                                <div class="card-body">
                                                  {{ $infos->construction_observation == null?'Aucune observation':$infos->construction_observation }}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item text-end">
                                            <b class="me-2 fst-italic">Enrégistré le :</b>
                                            <span class="text-danger">
                                                <i class="fa fa-calendar-plus fa-1x me-1"></i>
                                                {{ $infos->construction_date_depense }}
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
