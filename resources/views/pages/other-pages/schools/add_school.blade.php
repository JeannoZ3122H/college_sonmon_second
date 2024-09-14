@extends('main.admin_layout')
@section('title')
Ajouter une école
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Création d'école /</span> nouvelle école</h4>
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <h4 class="card-header">Création d'école</h4>

              <div class="card-body pt-2 mt-1">
                <form id="formAccountSettings" method="POST" action="{{ route('dashboard.add_school_request') }}">

                    @csrf

                <div class="row mt-2 gy-4">
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input
                          class="form-control"
                          type="text"
                          id="school_name"
                          name="school_name"
                          placeholder="École / Établissement"
                          autofocus />
                        <label for="school_name">École / Établissement</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                          <select id="country" name="localite" class="select2 form-select">
                            <option selected disabled>Selectionnez la localité</option>
                            <option value="Kounahiri">Kounahiri</option>
                            <option value="Soukourougban">Soukourougban</option>
                          </select>
                          <label for="country">Localité</label>
                        </div>
                      </div>
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input
                          class="form-control"
                          type="text"
                          id="email"
                          name="email"
                          placeholder="ecole.email@example.com" />
                        <label for="email">E-mail</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="text"
                            id="phoneNumber"
                            name="phone_number"
                            class="form-control"
                            placeholder="0905 9555 0111" />
                          <label for="phoneNumber">Fix de l'établissement</label>
                        </div>
                        <span class="input-group-text">CIV (+225)</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input
                          type="text"
                          class="form-control"
                          id="address"
                          name="address"
                          placeholder="Adresse de l'école" />
                        <label for="address">Adresse de l'école</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="date"
                            class="form-control"
                            id="date_creation"
                            name="date_creation"
                            placeholder="Date de création de l'école" />
                          <label for="date_creation">Date de création de l'école</label>
                        </div>
                      </div>
                  </div>
                  <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="mdi mdi-home-plus-outline me-2"></i>
                        Enregistrer l'école</button>
                    <button type="button" onclick="javascript:history.back()" class="btn btn-outline-danger me-2">Retour</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
      </div>
      <!-- / Content -->
@endsection
