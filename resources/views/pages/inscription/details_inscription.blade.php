@extends('main.admin_layout')
@section('title')
Détalis de l'inscription
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    @if ($_data)
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                        <div class="card invoice-preview-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-start flex-xl-row flex-md-column flex-sm-row flex-column">
                                    <div class="mb-xl-0 pb-3">
                                        <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
                                            <span class="app-brand-logo demo" style="color: var(--bs-primary); width: 10% !important">
                                                <span class="" style="color: var(--bs-primary); width: 10% !important">
                                                    <img src="{{ asset('assets/img/logo.png') }}" style="width: 100% !important" class="img-fluid"
                                                    alt="">
                                                </span>
                                            </span>
                                            <span style="width: 150px" class="h6 mb-0 text-black fw-bolder app-brand-text text-start fw-semibold">
                                                {{ $_user->school }}
                                            </span>
                                        </div>
                                        <p class="mb-1 text-dark">
                                            Office 149, 450 South Brand Brooklyn
                                        </p>
                                        <p class="mb-1 text-dark">San Diego County, CI 91905, CIV</p>
                                        <p class="mb-0 text-dark">
                                            +225 074 768 1227, +225 (015) 307 0970
                                        </p>
                                    </div>
                                    <div>
                                        <h4 class="fw-medium text-uppercase pb-1 text-black fw-bolder text-nowrap">
                                            Reçu d'inscription
                                            @if ($_data->id < 10)
                                                <span class="text-danger ms-2">#00{{ $_data->id }}</span>
                                            @elseif ($_data->id >= 10 && $_data->id < 999)
                                                <span class="text-danger ms-2">#0{{ $_data->id }}</span>
                                            @elseif ($_data->id > 999)
                                                <span class="text-danger ms-2">#{{ $_data->id }}</span>
                                            @endif
                                        </h4>
                                        <div class="mb-1">
                                            <span class="text-dark">Date:</span>
                                            <span class="text-black fw-bolder text-capitalize">{{ strftime("%d %B %Y", strtotime($_data->created_at)) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-dark">Date Due:</span>
                                            <span>May 25, 2021</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class="my-3 me-3">
                                        <h6>Conserné(e):</h6>
                                        <p class="mb-1">
                                            <span class="me-2 text-dark">Nom:</span>
                                            <span class="fw-bolder text-black">{{ $_data->fname }}</span>
                                        </p>
                                        <p class="mb-1">
                                            <span class="me-2 text-dark">Prénoms:</span>
                                            <span class="fw-bolder text-black">{{ $_data->lname }}</span>
                                        </p>
                                        <p class="mb-1">
                                            <span class="me-2 text-dark">Date de naissance:</span>
                                            <span class="fw-bolder text-black">{{ strftime("%d-%m-%Y", strtotime($_data->date_naissance)) }}</span>
                                        </p>
                                        <p class="mb-1">
                                            <span class="me-2 text-dark">Classe:</span>
                                            <span class="fw-bolder text-black">{{ $_data->niveau_etude }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="me-2 text-dark">Nº d'urgence:</span>
                                            <span class="fw-bolder text-black">{{ $_data->emergency_phone }}</span>
                                        </p>
                                    </div>
                                    <div class="my-3">
                                        <h6>Bill To:</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pe-3">Total Due:</td>
                                                    <td>$12,110.55</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">Bank name:</td>
                                                    <td>American Bank</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">Country:</td>
                                                    <td>United States</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">IBAN:</td>
                                                    <td>ETD95476213874685</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-3">SWIFT code:</td>
                                                    <td>BR91905</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered m-0">
                                    <thead class="border-top">
                                        <tr>
                                            <th>Versement</th>
                                            <th>Date de versement</th>
                                            <th>Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap text-heading">
                                                Vuexy Admin Template
                                            </td>
                                            <td class="text-nowrap">10/02/2023</td>
                                            <td>32 000 F CFA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-md-0 mb-3">
                                        <div>
                                            <p class="mb-2">
                                                <span class="me-1 text-heading text-dark">Scolarité:</span>
                                                <span>Alfie Solomons</span>
                                            </p>
                                            <span>Thanks for your business</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end mt-2">
                                        <div class="invoice-calculations">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="w-px-100">Déposé:</span>
                                                <h6 class="mb-0 pt-1 text-black fw-bolder">{{ ($_data->scolarite_total - $_data->scolarite_reste ).' F CFA' }}</h6>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="w-px-100">Reste:</span>
                                                <h6 class="mb-0 pt-1 text-black fw-bolder">{{ $_data->scolarite_reste.' F CFA' }}</h6>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="w-px-100">Taxe:</span>
                                                <h6 class="mb-0 pt-1 text-black fw-bolder">0 F CFA</h6>
                                            </div>
                                            <hr />
                                            <div class="d-flex justify-content-between">
                                                <span class="w-px-100">Total:</span>
                                                <h6 class="mb-0 pt-1 text-danger fw-bold">{{ $_data->scolarite_total.' F CFA' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="fw-medium text-black fw-bolder">NB:</span>
                                        <span class="text-dark">Veuilliez bien conserver ce reçu car il servira de faire valoir et aussi de preuve d'un versement effectué.
                                            Merci d'avance !
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice -->

                    <!-- Invoice Actions -->
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas"
                                    data-bs-target="#sendInvoiceOffcanvas">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                            class="mdi mdi-send-outline scaleX-n1-rtl me-2"></i>Envoyer</span>
                                </button>
                                <button class="btn btn-outline-secondary d-grid w-100 mb-3">
                                    Télécharger
                                </button>
                                <a class="btn btn-outline-secondary d-grid w-100 mb-3"
                                    target="_blank" href="{{ route('dashboard.print_inscription_invoice', $_data->id) }}">
                                    <i class="mdi mdi-printer me-1"></i>
                                    Imprimer
                                </a>
                                @if($_data->scolarite_reste > 0)
                                    <button class="btn btn-success d-grid w-100" data-bs-toggle="offcanvas"
                                        data-bs-target="#addPaymentOffcanvas">
                                        <span class="d-flex align-items-center justify-content-center text-nowrap">
                                            <i class="mdi mdi-cash me-1"></i>
                                            Payer mes frais
                                        </span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Actions -->
                </div>
                <!-- Add Payment Sidebar -->
                <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
                    <div class="offcanvas-header mb-3">
                        <h5 class="offcanvas-title">Payer mes frais</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body flex-grow-1">
                        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
                            <p class="mb-0 text-dark">Scolarité totale:</p>
                            <p class="fw-medium mb-0">{{ $_data->scolarite_total.' F CFA' }}</p>
                        </div>
                        <form action="{{ route('dashboard.buy_scolarite', $_data->id) }}" method="POST" >
                            @csrf
                            <div class="input-group input-group-merge mb-4">
                                <span class="input-group-text">F CFA</span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" disabled readonly id="invoiceAmount" value="{{ $_data->scolarite_reste }}"
                                        class="form-control invoice-amount" placeholder="100" />
                                    <label for="invoiceAmount">Montant restant</label>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input id="date_inscription" disabled value="{{ strftime("%d %B %Y", strtotime($_data->created_at)) }}" class="form-control invoice-date" type="text" />
                                <label for="date_inscription">Date d'incription</label>
                            </div>
                            <div class="input-group input-group-merge mb-4">
                                <span class="input-group-text">F CFA</span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="invoiceAmount" name="value"
                                        class="form-control invoice-amount" placeholder="100" />
                                    <label for="invoiceAmount">Montant à payer</label>
                                </div>
                            </div>
                            <div class="mb-3 d-flex flex-wrap">
                                <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                                    Payer
                                </button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                                    Retour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Add Payment Sidebar -->

                <!-- /Offcanvas -->
            </div>

            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
    @endif
</div>

@endsection
