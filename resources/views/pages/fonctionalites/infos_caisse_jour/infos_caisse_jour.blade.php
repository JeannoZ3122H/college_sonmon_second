@extends('main.admin_layout')
@section('title')
    Infos caisse du jour
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if (request()->route()->uri == 'contenu.infos.caisse.jour')
            <div class="row gy-4">
                <div class="col-12 text-end">
                    <h6 class="text-uppercase">Date d'informations sur la caisse: <b class="text-danger ms-2">{{ '22-04-2022' }}</b></h6>
                </div>
                <div class="col-12 text-center">
                    <h1 class="text-uppercase">Année scolaire <b class="text-primary">{{ session()->get('scolarite') }}</b></h1>
                </div>
                <!--/ Data Tables -->
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-white">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-truncate text-center text-wrap">Somme initiale</th>
                                        <th class="text-truncate text-center text-wrap">Entrée scolarité</th>
                                        <th class="text-truncate text-center text-wrap">Informatique</th>
                                        <th class="text-truncate text-center text-wrap">Alimentation caisse par la banque</th>
                                        <th class="text-truncate text-center text-wrap">Dépenses</th>
                                        <th class="text-truncate text-center text-wrap">Construction</th>
                                        <th class="text-truncate text-center text-wrap">Versement en banque</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- is last item class="border-transparent" --}}
                                    <tr>
                                        <td class="text-truncate text-center">0</td>
                                        <td class="text-truncate text-center">30000</td>
                                        <td class="text-truncate text-center">0</td>
                                        <td class="text-truncate text-center">0</td>
                                        <td class="text-truncate text-center">0</td>
                                        <td class="text-truncate text-center">0</td>
                                        <td class="text-truncate text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0 bg-transparent"></td>
                                        <td colspan="2" class="text-truncate text-center fs-5
                                        fw-bolder text-uppercase">2400000</td>
                                        <td class="border-0 bg-transparent"></td>
                                        <td colspan="2" class="text-truncate text-center fs-5
                                        fw-bolder text-uppercase">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-white">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bolder text-truncate text-wrap text-center">
                                            Reste
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-truncate text-center fs-6
                                        fw-bolder text-uppercase">2400000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--/ Data Tables -->
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
                    <h1 class="text-uppercase">Infos caisse du jour</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('show_infos_caisse_jour_content_by_years') }}" method="post">
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
