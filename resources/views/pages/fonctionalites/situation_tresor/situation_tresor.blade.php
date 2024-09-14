@extends('main.admin_layout')
@section('title')
    Situation trésor
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if (request()->route()->uri == 'contenu.situation.tresor')
            <div class="row gy-4">
                <div class="col-12 text-center">
                    <h1 class="text-uppercase">Année scolaire <b class="text-primary">{{ session()->get('scolarite') }}</b></h1>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-white">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="2" class="border-0 bg-transparent"></th>
                                        @foreach ($list_month as $month)
                                            <th class="text-truncate text-center text-wrap">{{ $month }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i=1; $i <= 4; $i++)
                                        <tr class="">
                                            @if($i == 1)
                                                <td rowspan="4" class="border-0 text-uppercase text-center py-1 px-2 bg-transparent">
                                                    Solde en début
                                                </td>
                                            @endif

                                            <td class="py-1 px-2">
                                                {{ ($i%2)==0?'Banque':'Caisse' }}
                                            </td>
                                            @foreach ($list_month as $month)
                                                <td class="py-1 px-2 text-center">
                                                    0
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endfor

                                    {{-- <tr class="">
                                         <td class="py-1 px-2">

                                         </td>
                                        @foreach ($list_month as $month)
                                            <td class="py-1 px-2 text-center">
                                                0
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="">
                                        <td class="py-1 px-2">

                                        </td>
                                        @foreach ($list_month as $month)
                                            <td class="py-1 px-2 text-center">
                                                0
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="">
                                        <td class="py-1 px-2">

                                        </td>
                                        @foreach ($list_month as $month)
                                            <td class="py-1 px-2 text-center">
                                                0
                                            </td>
                                        @endforeach
                                    </tr> --}}

                                </tbody>
                            </table>
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
                    <h1 class="text-uppercase">  Situation trésor</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('show_situation_tresor_content_by_years') }}" method="post">
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
