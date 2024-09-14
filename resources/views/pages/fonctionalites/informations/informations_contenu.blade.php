@extends('main.admin_layout')
@section('title')
    Informations
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4">
            <div class="col-12 text-start">
                <li class="text-uppercase h5">Année scolaire: <b class="text-primary ms-2">{{ session()->get('scolarite') }}</b></li>
                <li class="p-2 h5 ms-4 border border-black border-2">
                    <span class="text-uppercase">Détails</span>
                    <ul class="text-center ms-3 d-flex justify-content-between list-unstyled mt-3">
                        <li class="">
                            <span class="">Catégorie: </span><b class="text-danger text-uppercase ms-2">{{ session()->get('option_1') }}</b>
                        </li>
                        <li class="">
                            <span class="">Mois: </span><b class="text-danger text-uppercase ms-2">{{ $get_month }}</b>
                        </li>
                        <li class="">
                            <span class="">Semaine: </span><b class="text-danger text-uppercase ms-2">{{ $value == 'all'?'Toutes les semaines':'Semaine '.$value }}</b>
                        </li>
                    </ul>
                </li>
                @if (session()->get('option_2'))
                    <li class="list-unstyled h5 ms-5 pt-2 px-2 mb-0 border border-black border-2">
                        <ul class="row justify-content-between">
                            <li class="col-auto">
                                Période: <b class="text-dark text-lowercase ms-2">{{ $period_for_tag }}</b>
                            </li>
                            <li class="col-auto">
                                Soit: <b class="text-secondary fst-italic text-lowercase mx-1">({{ $value != 'all'?count($all_date_for_month['item']):$day_open }})</b>
                               <i><small>Jours ouvrables</small></i>
                            </li>
                        </ul>
                    </li>
                @endif
            </div>

            @foreach ($all_date_for_month as $key => $date)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-white">
                                <thead class="table-light">
                                    <tr>
                                        @foreach ($list_libelle as $item)
                                            <th class="text-nowrap text-center">{{ $item }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($date as $d)
                                        <tr class="">
                                            @foreach ($list_libelle as $key => $item)
                                                @if($key == 0)
                                                    <td class="border-0 text-nowrap text-center py-1 px-2 bg-transparent">
                                                        {{ date('l, F d, Y', strtotime($d)); }}
                                                    </td>
                                                @else
                                                    <td class="py-1 text-nowrap px-2 text-center">
                                                        0
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered table-white">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="{{ count($list_libelle) }}" class="text-nowrap text-uppercase text-center">
                                        {{ $value == 'all'?'Total du mois':'Total de la semaine'.$value }}
                                    </th>
                                </tr>
                                <tr>
                                    @foreach ($list_libelle as $key => $item)
                                        @if ($key != 0)
                                            <th class="text-nowrap text-center">{{ $item }}</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    @foreach ($list_libelle as $key => $item)
                                        @if($key != 0)
                                            <td class="py-1 text-nowrap px-2 text-center">
                                                0
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered table-white">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="{{ count($list_libelle) }}" class="text-nowrap text-uppercase text-center">
                                        Solde actuelle de la caisse
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-nowrap text-center">Entree</th>
                                    <th class="text-uppercase text-nowrap text-center">Sortie</th>
                                    <th class="text-uppercase text-nowrap text-center">Solde</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="py-1 text-nowrap px-2 text-center">0</td>
                                    <td class="py-1 text-nowrap px-2 text-center">0</td>
                                    <td class="py-1 text-nowrap px-2 text-center">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ url()->previous() }}"
                    class="btn btn-danger btn-buy-now">
                    Retour
                </a>
            </div>
        </div>
    </div>
@endsection
