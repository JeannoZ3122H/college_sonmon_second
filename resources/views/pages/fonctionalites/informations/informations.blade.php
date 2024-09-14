@extends('main.admin_layout')
@section('title')
    Informations
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (request()->route()->uri == 'contenu.informations')
            <div class="row gy-4">
                <div class="col-12 text-start">
                    <li class="text-uppercase h5">Année scolaire: <b class="text-primary ms-2">{{ session()->get('scolarite') }}</b></li>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <p class=" text-dark">Veuillez choisir le type d'info de la caisse souhaitez-vous obtenir</p>
                                <hr>
                            </div>
                            <div class="text-center d-flex justify-content-center flex-wrap">
                                <a href="{{ route('dashboard.informations.option_1', 'hebdo') }}" class="btn btn_select_month btn-secondary mx-3">Hebdomadaire</a>
                                <a href="{{ route('dashboard.informations.option_1', 'mensuel') }}" class="btn btn_select_month btn-secondary mx-3">Mensuel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ url()->previous() }}"
                    class="btn btn-danger btn-buy-now">
                    Retour
                </a>
            </div>
        @else
            <div class="row my-4 justify-content-center">
                <div class="col-12 text-center">
                    <h1 class="text-uppercase">informations</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('show_informations_content_by_years') }}" method="post">
                            @csrf
                            <div class="text-center row my-2 justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="date_start" id="date_start" placeholder="...">
                                        <label for="date_start">Date début d'année scolaire</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="date_fin" id="date_fin" placeholder="...">
                                        <label for="date_fin">Date fin d'année scolaire</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search me-2"></i>
                                    Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')

@endsection
