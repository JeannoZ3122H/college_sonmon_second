@extends('main.admin_layout')
@section('title')
Liste des inscriptions
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des inscriptions</span></h4>
    <a href="{{ route('dashboard.inscription_student_step_one') }}" class="btn btn-primary text-white mb-3 mt-1 me-2">
        <i class="mdi mdi-home-plus-outline me-2"></i>
        Faire une inscriptions
    </a>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <h4 class="card-header">Liste</h4>
                <div class="col-12">

                    <div class="card p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bolder fst-italic">#ID</th>
                                        <th class="text-truncate">Nom et Prénoms</th>
                                        <th class="text-truncate">Matricule</th>
                                        <th class="text-truncate">Contact d'urgence</th>
                                        <th class="text-truncate">Classe</th>
                                        <th class="text-truncate">Année scolaire</th>
                                        <th class="text-truncate">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liste_inscription as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td class="text-truncate">{{ $item->fname.' '.$item->lname }}</td>
                                        <td class="text-truncate">{{ $item->matricule }}</td>
                                        <td class="text-truncate">{{ $item->emergency_phone }}</td>
                                        <td class="text-truncate">{{ $item->niveau_etude }}</td>
                                        <td class="text-truncate">{{ $item->scolarite_years }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-block">
                                                <a href="javascript:;"
                                                class="btn btn-sm btn-warning rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical fs-3"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end m-0">
                                                    @if ($item->scolarite_reste > 0)
                                                        <a href="{{ route('dashboard.edit_inscription', $item->id) }}"
                                                            class="dropdown-item text-dark delete-record">
                                                            <i class="mdi mdi-cash text-warning me-2"></i>
                                                            Payé
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('dashboard.view_details', $item->id) }}"
                                                     class="dropdown-item text-dark delete-record">
                                                     <i class="mdi mdi-eye-arrow-right text-warning me-2"></i>
                                                     Voir
                                                    </a>

                                                    <a href="{{ route('dashboard.edit_scolarite', $item->id) }}"
                                                     class="dropdown-item text-dark delete-record">
                                                     <i class="mdi mdi-text-box-edit-outline text-warning me-2"></i>
                                                     Modifier
                                                    </a>

                                                    <a href="{{ route('dashboard.delete_new_scolarite', $item->id) }}"
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
