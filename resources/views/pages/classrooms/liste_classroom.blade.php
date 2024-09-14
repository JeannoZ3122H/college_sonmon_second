
@extends('main.admin_layout')
@section('title')
Liste des rôles
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des classes</span></h4>
    <a href="{{ route('dashboard.add_classroom') }}" class="btn btn-primary text-white mb-3 mt-1 me-2">
        <i class="mdi mdi-home-plus-outline me-2"></i>
        Ajouter une classe
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
                                        <th class="text-truncate">Classe</th>
                                        <th class="text-truncate">Bâtiment</th>
                                        <th class="text-truncate">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liste_classroom as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td class="text-truncate">{{ $item->classroom.$item->level }}</td>
                                        <td class="text-truncate">{{ $item->building == null?'aucun':$item->building }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-block">
                                                <a href="javascript:;"
                                                class="btn btn-sm btn-warning rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical fs-3"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end m-0">
                                                    <a href="{{ route('dashboard.edit_classroom', $item->id) }}"
                                                     class="dropdown-item text-dark delete-record">
                                                     <i class="mdi mdi-text-box-edit-outline text-warning me-2"></i>
                                                     Modifier
                                                    </a>

                                                    <a href="{{ route('dashboard.delete_new_classroom', $item->id) }}"
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
