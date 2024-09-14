@extends('main.admin_layout')
@section('title')
Payement des frais d'inscriptions
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-kanban">

        @if (Session::get('_data'))
            <div class="row">
                <div class="col-12">
                    <h6 class="text-muted">
                        Payement des frais d'inscriptions
                        <i class="menu-icon tf-icons ms-2 mdi mdi-account-multiple-plus"></i>
                    </h6>
                    <div class="">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 col-12" id="start-buy-bloc">
                                <div class="card text-center m-2">
                                    <div class="card-body">
                                        <h5 class="card-title">Frais d'inscription</h5>
                                        <p class="card-text"><i class="mdi mdi-cash-multiple fs-1"></i></p>
                                        <p class="card-text text-danger fw-bold">
                                            {{ Session::get('_data')->scolarite_total }}
                                            <span class="ms-1 ">F CFA</span>
                                        </p>
                                        <button type="button" onclick="goToStep2()"
                                            class="btn border btn-toggle btn-primary waves-effect">
                                            <span class="tf-icons mdi mdi-checkbox-multiple-marked-circle me-3"></span>
                                            Payé
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 col-12 d-none" id="buy-bloc">
                                <div class="card m-2">
                                    <div class="card-body">
                                        <h2 class="text-center fw-bolder" id="show-niv"></h2>

                                        <form action="{{ route('dashboard.buy_scolarite', Session::get('_data')->id) }}" method="POST" >
                                            @csrf
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" min="0" class="form-control" id="value" name="value" value="0" placeholder="">
                                                        <label for="value">Montant</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <button type="submit"
                                                        class="btn border btn-toggle btn-primary waves-effect">
                                                        <span class="tf-icons mdi mdi-checkbox-multiple-marked-circle me-3"></span>
                                                        Valider
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        @if ($get_data)
                                            <div class="row pe-3">
                                                <div class="card m-2">
                                                    <div class="card-body">
                                                        <h2 class="text-center fw-bolder" id="show-niv"></h2>
                                                        <hr>
                                                        <div class="row justify-content-center me-2">
                                                            <div class="col-lg-10 col-12">
                                                                <h5 class="ms-4 mb-3">Scolarité:<span class="ms-3 fw-bolder" id="scolarite">{{ $get_data->scolarite_total }}</span></h5>
                                                                <h5 class="ms-4 mb-3">Année scolaire:<span class="ms-3 fw-bolder" id="school_year">{{ $get_data->scolarite_years }}</span></h5>
                                                                <h5 class="ms-4 mb-3">Collège:<span class="ms-3 fw-bolder" id="cll">{{ $_user->school }}</span></h5>
                                                            </div>
                                                            <div class="col-lg-2 col-12 text-end">
                                                                <span class="tf-icons mdi mdi-book-open-page-variant text-green me-3 fs-big"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-none" id="info-btn">
                                <div class="d-flex justify-content-center">
                                    <button type="button" onclick="removeActive()" class="btn m-2 border btn-danger waves-effect">
                                        <span class="tf-icons mdi mdi-close-box-multiple me-3"></span>
                                        Changer
                                    </button>
                                    <button type="button" onclick="goToNextStep()" class="btn m-2 border btn-primary waves-effect">
                                        <span class="tf-icons mdi mdi-check-underline-circle me-3"></span>
                                        Confirmer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button onclick="history.back()" class="btn btn-danger">
                    <i class="mdi mdi-reply-all me-2"></i>
                    Retour
                </button>
            </div>
        @endif

    </div>
</div>
<style>
    .fs-big{
        font-size: 5.875rem !important;
    }
    .text-green{
        color: #249441 !important;
    }
</style>

<script>

    function goToStep2(){

        let start_buy = document.querySelector('#start-buy-bloc');
        let _buy = document.querySelector('#buy-bloc');

        start_buy.classList.add('d-none');
        _buy.classList.remove('d-none');

        let convert = JSON.parse(localStorage.getItem('scolarite'));
        document.querySelector('#show-niv').innerHTML = convert.niveau_etude;
        document.querySelector('#scolarite').innerHTML = convert.price+' '+' F CFA';
        document.querySelector('#school_year').innerHTML = convert.school_year_start+'-'+convert.school_year_end;
    }
</script>

@endsection

