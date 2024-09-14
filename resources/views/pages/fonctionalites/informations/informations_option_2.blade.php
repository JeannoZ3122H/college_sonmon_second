@extends('main.admin_layout')
@section('title')
    Informations {{ $option_2 }}
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4">
            <div class="col-12 text-start">
                <li class="text-uppercase h5">Année scolaire: <b class="text-primary ms-2">{{ session()->get('scolarite') }}</b></li>
                @if (session()->get('option_1') == 'hebdomadaire')
                    <li class="text-uppercase h5 ms-4">informations hebdomadaire: <b class="text-primary ms-2">{{ $get_month }}</b></li>
                @endif
                @if (session()->get('option_1') == 'mensuel')
                    <li class="text-uppercase h5 ms-4">informations mensuel: <b class="text-primary ms-2">{{ $get_month }}</b></li>
                @endif
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <p class=" text-dark">Veuillez choisir la semaine pour d'info sur la caisse que souhaitez-vous obtenir</p>
                            <hr>
                        </div>

                        @if (session()->get('option_1') == 'hebdomadaire')
                            <div class="text-center d-flex justify-content-center flex-wrap">
                                @for ($i = 1; $i <= $nbreWeek; $i++)
                                    <a href="{{ route('dashboard.informations_resultats', $i) }}" class="btn btn_select_month btn-secondary m-3">Semaine {{ $i }}</a>
                                @endfor
                            </div>
                        @else
                            <div class="text-center d-flex justify-content-center flex-wrap">
                                <a href="{{ route('dashboard.informations_resultats', 'all') }}" class="btn btn_select_month btn-secondary m-3">Toutes les Semaines</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <a href="{{ route('dashboard.informations.option_1', session()->get('option_1')) }}"
                class="btn btn-danger btn-buy-now">
                Retour
            </a>
        </div>
    </div>
@endsection
