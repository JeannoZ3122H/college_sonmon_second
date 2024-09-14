@extends('main.admin_layout')
@section('title')
Liste de mouvement bancaire
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-dark fw-light">Liste de mouvement bancaire</span></h4>
    <a href="{{ route('dashboard.add_movement_bank') }}" class="btn btn-primary text-white mb-3 mt-1 me-2">
        <i class="mdi mdi-plus-outline me-2"></i>
       Ajouter un mouvement bancaire
    </a>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body py-1 mb-lg-3 mb-2">

                @if (request()->route()->uri == 'search_movement_bank/{type}')
                    <div class="col-12 text-end mb-3">
                        <a href="{{ route('dashboard.liste_movement_bank') }}" class="btn btn-danger m-2">
                            <i class="fa fa-refresh me-2"></i> Voir toute la liste
                        </a>
                    </div>
                @endif

                <div id="eventContentShowForms" class="col-12 d-flex justify-content-end">
                    <button type="button" onclick="eventForms('single')" class="btn btn-primary m-2">Rechecher par libellé mouvement bancaire</button>
                    <button type="button" onclick="eventForms('group')" class="btn btn-secondary m-2">Rechecher par période</button>
                </div>

                <div id="initEventContentShowForms" class="col-12 d-none text-end">
                    <button type="button" onclick="initEventForms()" class="btn btn-secondary m-2">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>

                <div id="isSearchByItem" class="d-none">
                    <div class="row justify-content-center">
                        <form action="{{ route('search_movement_bank', 'single') }}" class="col-lg-8 col-12 mb-lg-0 mb-3" method="post">
                            @csrf
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                                <div class="form-floating form-floating-outline">
                                    <input type="search" class="form-control form-control-lg"
                                    id="search_single" name="search_single" placeholder="...">
                                    <label for="search_single"><small>Entrer ici le libellé...</small></label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary mt-2">
                                    <i class="fa fa-search me-2 text-white"></i>
                                    Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="isSearchByDate" class="d-none">
                    <div class="row justify-content-center">
                        <form action="{{ route('search_movement_bank', 'group') }}"
                        class="col-lg-8 row justify-content-center col-12 mb-lg-0 mb-2" method="post">
                            @csrf
                            <div class="col-md-6 col-12 mb-lg-0 mb-lg-0 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-check"></i>
                                    </span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="date_start" class="form-control form-control-lg"
                                        id="date_start" placeholder="...">
                                        <label for="date_start"><small>Date début</small></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-lg-0 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-check"></i>
                                    </span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="date_fin" class="form-control form-control-lg"
                                        id="date_fin" placeholder="...">
                                        <label for="date_fin"><small>Date fin</small></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mb-lg-0 mb-2">
                                <button type="submit" class="btn btn-primary mt-2">
                                    <i class="fa fa-search me-2 text-white"></i>
                                    Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="col-12">
                    <div class="card p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bolder fst-italic">#ID</th>
                                        <th class="text-truncate">DATE</th>
                                        <th class="text-truncate">LIBELLES</th>
                                        <th class="text-truncate">BANQUE</th>
                                        <th class="text-truncate">VERSEMENT EN BANQUE</th>
                                        <th class="text-truncate">ALIMENTATION DE LA CAISSE PAR LA BANQUE</th>
                                        <th class="text-truncate">SOLDE</th>
                                        <th class="text-truncate">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td class="text-truncate">{{ $item->movement_bank_date }}</td>
                                        <td class="text-truncate">{{ $item->movement_bank_libelle }}</td>
                                        <td class="text-truncate">{{ $item->bank }}</td>
                                        <td class="text-truncate">{{ $item->versement_bank }}</td>
                                        <td class="text-truncate">{{ $item->alimentation_box_by_bank==null?'Aucun':$item->alimentation_box_by_bank }}</td>
                                        <td class="text-truncate">{{ $item->balances }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-block">
                                                <a href="javascript:;"
                                                class="btn btn-sm btn-warning rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical fs-3"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end m-0">

                                                    <a href="{{ route('dashboard.detail_movement_bank', $item->slug) }}"
                                                     class="dropdown-item text-dark delete-record">
                                                        <i class="mdi mdi-eye-arrow-right text-warning me-2"></i>
                                                        Voir
                                                    </a>

                                                    <a href="{{ route('dashboard.edit_movement_bank', $item->id) }}"
                                                     class="dropdown-item text-dark delete-record">
                                                     <i class="mdi mdi-text-box-edit-outline text-warning me-2"></i>
                                                        Modifier
                                                    </a>

                                                    <a href="{{ route('dashboard.delete_movement_bank', $item->id) }}"
                                                     class="dropdown-item text-dark delete-record">
                                                        <i class="mdi mdi-delete text-danger me-2"></i>
                                                        Supprimer
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function eventForms(e){
            let eventContent = document.querySelector('#eventContentShowForms');
            let single = document.querySelector('#isSearchByItem');
            let group = document.querySelector('#isSearchByDate');
            let initEventContent = document.querySelector('#initEventContentShowForms');

            if(e == 'group'){
                group.classList.remove('d-none');
                single.classList.add('d-none');
                eventContent.classList.add('d-none');
                initEventContent.classList.remove('d-none');
            }

            if(e == 'single'){
                single.classList.remove('d-none');
                group.classList.add('d-none');
                eventContent.classList.add('d-none');
                initEventContent.classList.remove('d-none');
            }
        }

        function initEventForms(){
            let initEventContent = document.querySelector('#initEventContentShowForms');
            let eventContent = document.querySelector('#eventContentShowForms');
            let single = document.querySelector('#isSearchByItem');
            let group = document.querySelector('#isSearchByDate');

            group.classList.add('d-none');
            single.classList.add('d-none');
            eventContent.classList.remove('d-none');
            initEventContent.classList.add('d-none');
        }
    </script>
@endsection
