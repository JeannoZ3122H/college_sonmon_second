@extends('main.admin_layout')
@section('title')
Modifier un rôle
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier de rôle</span></h4>
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card mb-4">
                    <h4 class="card-header">Modifier de rôle</h4>
                    <div class="card-body pt-2 mt-1">
                        @if($data)
                            <form id="formAccountSettings" method="POST" action="{{ route('dashboard.update_role_request', $data->id) }}">
                                @csrf
                                <div class="row mt-2 justify-content-center">
                                    <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                        class="form-control"
                                        type="text"
                                        id="role"
                                        value="{{ $data->role }}"
                                        name="role"
                                        placeholder="Rôle"
                                        autofocus />
                                        <label for="role">Rôle</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="mdi mdi-home-plus-outline me-2"></i>
                                        Modifier le rôle</button>
                                    <button type="button" onclick="javascript:history.back()"
                                        class="btn btn-outline-danger me-2">Annuler</button>
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
