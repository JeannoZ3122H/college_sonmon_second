@extends('main.admin_layout')
@section('title')
    Mon profil
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Mon profil /</span> Compte</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h4 class="card-header">Détails du profil</h4>
                    <!-- Account -->
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-12">
                            <div class="card-body mt-5">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $data->admin_img }}" alt="user-avatar"
                                        class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-12">
                            <div class="card-body pt-2 mt-1">
                                <div id="formAccountSettings">
                                    <div class="row mt-2 gy-4">
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input class="form-control" type="text" placeholder="Votre nom" id="firstName" disabled value="{{  $data->fname }}"
                                                    />
                                                <label for="firstName">Nom</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  $data->lname }}" id="lastName" />
                                                <label for="lastName">Prénoms</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input class="form-control" type="text" id="email" disabled value="{{  $data->email }}"
                                                    placeholder="john.doe@example.com" />
                                                <label for="email">E-mail</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                    <select id="school" disabled class="select2 form-select">
                                                        <option value="" selected disabled>{{ $data->school }}</option>
                                                    </select>
                                                <label for="school">École / Établissement</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="phoneNumber" disabled value="{{  $data->phone }}" class="form-control"
                                                        placeholder="202 555 0111" />
                                                    <label for="phoneNumber">Nº de téléphone</label>
                                                </div>
                                                <span class="input-group-text">CIV (+225)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="address" disabled value="{{  $data->address }}"
                                                    placeholder="Address" />
                                                <label for="address">Adresse de résidence</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input class="form-control" type="text" id="city" disabled value="{{  $data->city }}"
                                                    placeholder="Ville" />
                                                <label for="city">Ville</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="fonction" disabled value="{{  $data->fonction }}"
                                                    placeholder="Enseignant assistant" />
                                                <label for="fonction">Fonction</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="matricule" disabled value="{{  $data->matricule }}"
                                                    placeholder="2012993755JD" maxlength="10" />
                                                <label for="matricule">Matricule</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select id="role_id" disabled class="select2 form-select">
                                                    <option disabled selected>{{  Auth::user()->role }}</option>
                                                </select>
                                                <label for="role_id">Rôle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="text-end mt-3">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-danger btn-buy-now">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
