@extends('main.admin_layout')
@section('title')
    Informations {{ $option_1 }}
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if ($option_1 == 'hebdomadaire')
            <div class="row gy-4">
                <div class="col-12 text-start">
                    <li class="text-uppercase h5">Année scolaire: <b class="text-primary ms-2">{{ session()->get('scolarite') }}</b></li>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <p class=" text-dark">Veuillez choisir le mois pour les informations hebdomadaires</p>
                                <hr>
                            </div>
                            <div class="text-center d-flex justify-content-center flex-wrap">
                                @foreach ($list_month as $key => $month)
                                    <a href="{{ route('dashboard.informations.option_2', $key+1) }}" class="btn btn_select_month btn-secondary m-2">{{ $month }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('dashboard.informations') }}"
                    class="btn btn-danger btn-buy-now">
                    Retour
                </a>
            </div>
        @elseif ($option_1 == 'mensuel')
            <div class="row gy-4">
                <div class="col-12 text-start">
                    <li class="text-uppercase h5">Année scolaire <b class="text-primary">{{ session()->get('scolarite') }}</b></li>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <p class=" text-dark">Veuillez choisir le mois pour les informations</p>
                            </div>
                            <div class="text-center d-flex justify-content-center flex-wrap">
                                @foreach ($list_month as $key => $month)
                                    <a href="{{ route('dashboard.informations.option_2', $key+1) }}" class="btn btn_select_month btn-secondary m-2">{{ $month }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('dashboard.informations') }}"
                    class="btn btn-danger btn-buy-now">
                    Retour
                </a>
            </div>
        @endif
    </div>
@endsection
