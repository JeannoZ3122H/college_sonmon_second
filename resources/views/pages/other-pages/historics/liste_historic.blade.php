@extends('main.admin_layout')
@section('title')
Liste des historiques d'inscriptions
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des historiques d'inscriptions</span></h4>
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
                                        <th class="text-truncate">Auteur</th>
                                        <th class="text-truncate">Conserné</th>
                                        <th class="text-truncate">Date de création</th>
                                        <th class="text-truncate">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_historics as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td class="text-truncate">{{ $item->fname.' '.$item->lname }}</td>
                                        <td class="text-truncate">{{ $item->fname.' '.$item->lname }}</td>
                                        <td class="text-truncate">{{ $item->created_at }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-block">
                                                <a href="javascript:;"
                                                class="btn btn-sm btn-warning rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical fs-3"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end m-0">
                                                    <a href="{{ route('dashboard.detail_historic', $item->slug) }}"
                                                        class="dropdown-item text-dark delete-record">
                                                        <i class="mdi mdi-eye-arrow-right text-warning me-2"></i>
                                                        Voir
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
