@extends('main.admin_layout')
@section('title')
Modifier une école
@endsection
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Nodifier d'école</span></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h4 class="card-header">Nodifier d'école</h4>
                <div class="card-body pt-2 mt-1">
                    @if($data)
                        <form id="formAccountSettings" method="POST" action="{{ route('dashboard.update_school_request', $data->id) }}">
                            @csrf
                            <div class="row mt-2 gy-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="school_name" value="{{ $data->school_name }}" name="school_name"
                                            placeholder="École / Établissement" autofocus />
                                        <label for="school_name">École / Établissement</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select id="country" value="{{ $data->localite }}" name="localite" class="select2 form-select">
                                            <option selected>{{ $data->localite }}</option>
                                            <option value="Kounahiri">Kounahiri</option>
                                            <option value="Soukourougban">Soukourougban</option>
                                        </select>
                                        <label for="country">Localité</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="email" name="email" value="{{ $data->email }}"
                                            placeholder="ecole.email@example.com" />
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="phoneNumber" name="phone_number"value="{{ $data->phone_number }}" class="form-control"
                                                placeholder="0905 9555 0111" />
                                            <label for="phoneNumber">Fix de l'établissement</label>
                                        </div>
                                        <span class="input-group-text">CIV (+225)</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="address"value="{{ $data->address }}" name="address"
                                            placeholder="Adresse de l'école" />
                                        <label for="address">Adresse de l'école</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_creation"value="{{ $data->date_creation }}" name="date_creation"
                                            placeholder="Date de création de l'école" />
                                        <label for="date_creation">Date de création de l'école</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-home-plus-outline me-2"></i>
                                    Modifier l'école</button>
                                <button type="button" onclick="javascript:history.back()"
                                    class="btn btn-outline-danger me-2">Retour</button>
                            </div>
                        </form>
                    @endif
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection
