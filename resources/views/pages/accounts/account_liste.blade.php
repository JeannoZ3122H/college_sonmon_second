@extends('main.admin_layout')
@section('title')
Liste des comptes administrateurs
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des comptes administrateurs</span></h4>
        <a href="{{ route('dashboard.add_admin_account') }}" class="btn btn-primary text-white mb-3 mt-1 me-2">
            <i class="mdi mdi-home-plus-outline me-2"></i>
            Ajouter un compte
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
                                            <th class="text-truncate">Administrateur</th>
                                            <th class="text-truncate">Contact</th>
                                            <th class="text-truncate">Matricule</th>
                                            <th class="text-truncate">Fonction</th>
                                            <th class="text-truncate">status</th>
                                            <th class="text-truncate">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($liste_admin as $item)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        <img src="{{ $item->admin_img }}" alt="Avatar"
                                                            class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-truncate">{{ $item->fname.' '.$item->lname }}
                                                        </h6>
                                                        <small class="text-truncate">{{ $item->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-truncate"> {{ $item->phone }} </td>
                                            <td class="text-truncate"> {{ $item->matricule }}</td>
                                            <td class="text-truncate"> {{ $item->fonction }}</td>
                                            @if ($item->status_account == 0)
                                            <td class="d-flex justify-content-center">
                                                <span class="badge badge-center rounded-pill bg-danger me-1">
                                                    <i class="mdi mdi-account-remove-outline"></i>
                                                </span>
                                                <span class="ms-0 fw-bolder"><small>Désactivé</small></span>
                                            </td>
                                            @else
                                            <td class="d-flex justify-content-center">
                                                <span class="badge badge-center rounded-pill bg-success me-1">
                                                    <i class="mdi mdi-account-check-outline"></i></span>
                                                <span class="ms-0 fw-bolder"><small>Activé</small></span>
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="btn btn-sm btn-warning rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="mdi mdi-dots-vertical fs-3"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                                        @if ($item->status == 0)
                                                        <a role="button" data-bs-toggle="modal"
                                                            data-bs-target="#animationModal"
                                                            class="dropdown-item text-dark delete-record"
                                                            onclick="getUserData('{{ $item->email }}', '{{ $item->id }}' )">
                                                            <i class="mdi mdi-text-box-edit-outline text-warning me-2"></i>
                                                            Acitivé
                                                        </a>
                                                        @endif

                                                        <a href="{{ route('dashboard.edit_admin_account', $item->id) }}"
                                                            class="dropdown-item text-dark delete-record">
                                                            <i class="mdi mdi-text-box-edit-outline text-warning me-2"></i>
                                                            Modifier
                                                        </a>

                                                        <a href="{{ route('dashboard.delete_new_admin_account', $item->id) }}"
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
    <div class="modal fade animate__animated fadeIn" id="animationModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="exampleModalLabel5">Activation de compte</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.check_user_account') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="d-flex justify-content-center mb-4">
                            <div class="col-2">
                                <input type="number" id="id" name="id" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="email" readonly name="email" class="form-control">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-2">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control border-end-0" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="password">Mot de passe</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer">
                                        <i class="mdi mdi-eye-off-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Activation du compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let fullname = document.querySelector('#fullname');
        let email = document.querySelector('#email');
        let id = document.querySelector('#id');

        function getUserData(item_email, item_id){

            console.log(item_email)
            console.log(item_id)
            // let get_data = JSON.parse(data);

            // console.log(get_data);
            email.setAttribute('value', item_email);
            id.setAttribute('value', item_id);
        }

    </script>
@endsection
