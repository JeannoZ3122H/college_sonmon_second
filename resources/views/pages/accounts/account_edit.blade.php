@extends('main.admin_layout')
@section('title')
Modification du compte
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Modification de compte admin /</span> super-admin</h4>

    @if ($data)
        <form id="formAccountSettings" method="POST" action="{{ route('dashboard.update_admin_account_request', $data->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h4 class="card-header">Modification de compte</h4>
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ $data->admin_img }}" alt="user-avatar"
                                    class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                        <span class="d-none d-sm-block">Changer la photo ici</span>
                                        <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="admin_img" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" />
                                    </label>
                                    <div class="text-muted small">JPG, GIF ou PNG autorisés. Taille maximale de 800K</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-2 mt-1">
                            <div id="formAccountSettings">

                                <div class="row mt-2 gy-4">
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" value="{{ $data->fname }}" placeholder="Votre nom" id="firstName" name="fname"
                                                autofocus />
                                            <label for="firstName">Nom</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control"value="{{ $data->lname }}" type="text" placeholder="Votre prénom" name="lname" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" value="{{ $data->email }}" type="text" id="email" name="email"
                                                placeholder="john.doe@example.com" />
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                                <select id="school" value="{{ $data->school }}" name="school" class="select2 form-select">
                                                    <option selected>{{ $data->school }}</option>
                                                    @foreach ($liste_school as $school)
                                                        <option value="{{ $school->school_name.' '.$school->localite }}">{{ $school->school_name. ' '.$school->localite  }}</option>
                                                    @endforeach
                                                </select>
                                            <label for="school">École / Établissement</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input value="{{ $data->phone }}" type="text" id="phoneNumber" name="phone" class="form-control"
                                                    placeholder="202 555 0111" />
                                                <label for="phoneNumber">Nº de téléphone</label>
                                            </div>
                                            <span class="input-group-text">CIV (+225)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input value="{{ $data->address }}" type="text" class="form-control" id="address" name="address"
                                                placeholder="Address" />
                                            <label for="address">Adresse de résidence</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input value="{{ $data->city }}" class="form-control" type="text" id="city" name="city"
                                                placeholder="Ville" />
                                            <label for="city">Ville</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input value="{{ $data->fonction }}" type="text" class="form-control" id="fonction" name="fonction"
                                                placeholder="Enseignant assistant" maxlength="6" />
                                            <label for="fonction">Fonction</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input value="{{ $data->matricule }}" type="text" class="form-control" id="matricule" name="matricule"
                                                placeholder="2012993755JD" maxlength="10" />
                                            <label for="matricule">Matricule</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select id="role_id" name="role_id" class="select2 form-select">
                                                <option selected value="{{ $data->role_id }}">{{ $data->role }}</option>
                                                @foreach ($liste_role as $role)
                                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                @endforeach
                                            </select>
                                            <label for="role_id">Rôle</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary me-2"><i class="menu-icon tf-icons mdi mdi-content-save-check-outline me-2"></i> Enregistrer</button>
                        <a role="button" href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>
@endsection
