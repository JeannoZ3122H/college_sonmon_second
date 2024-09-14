@extends('main.admin_layout')
@section('title')
    Bilan financier
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if (request()->route()->uri == 'contenu.bilan.financier')
            <div class="row gy-4">
                <div class="col-12 text-center">
                    <h1 class="text-uppercase">Année scolaire <b class="text-primary">{{ session()->get('scolarite') }}</b></h1>
                </div>
                <!--/ Data Tables -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-danger">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bolder text-truncate text-wrap text-center">
                                            Alimentation caisse par la banque
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-truncate text-center fs-2
                                        fw-bolder text-uppercase">2400000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-info">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bolder text-truncate text-center">
                                            Informatique
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-truncate text-center fs-2
                                        fw-bolder text-uppercase">2400000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-white">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bolder text-truncate text-center">
                                            Dépense école
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- is last item class="border-transparent" --}}
                                    <tr>
                                        <td class="text-truncate text-center fs-5 fw-bolder text-uppercase">
                                            2400000
                                        </td>
                                    </tr>
                                </tbody>
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bolder text-truncate text-center">
                                            reste en caisse école
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-truncate text-center fs-5
                                        fw-bolder text-uppercase">2400000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-success">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="4" class="fw-bolder text-truncate text-center">
                                            Entrée en caise du 2021-2022
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-truncate">Niveau d'étude</th>
                                        <th class="text-truncate">Prévu</th>
                                        <th class="text-truncate">Recouvre</th>
                                        <th class="text-truncate">Reste</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- is last item class="border-transparent" --}}
                                    <tr>
                                        <td class="text-truncate">12000</td>
                                        <td class="text-truncate">24000</td>
                                        <td class="text-truncate">2400</td>
                                        <td class="text-truncate">24040</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate fw-bolder text-uppercase">Total</td>
                                        <td class="text-truncate">24000</td>
                                        <td class="text-truncate">2400</td>
                                        <td class="text-truncate">24040</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-truncate text-center fs-2
                                        fw-bolder text-uppercase">2400000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="4" class="fw-bolder text-truncate text-center">
                                            Dépenses
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-truncate">Dépenses</th>
                                        <th class="text-truncate">Construction</th>
                                        <th class="text-truncate">Versement en banque</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- is last item class="border-transparent" --}}
                                    <tr>
                                        <td class="text-truncate">12000</td>
                                        <td class="text-truncate">24000</td>
                                        <td class="text-truncate">2400</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-truncate text-center
                                        fw-bolder text-uppercase">Total sortie en caisse</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-truncate text-center fs-2
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
                    <h1 class="text-uppercase">Bilan financier</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('show_bilan_financier_content_by_years') }}" method="post">
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
