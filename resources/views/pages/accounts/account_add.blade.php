
@extends('main.admin_layout')
@section('title')
Ajouter un compte admin
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Création de compte admin /</span> super-admin</h4>
        <form id="formAccountSettings" method="POST" action="{{ route('dashboard.add_admin_account_request') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h4 class="card-header">Création de compte</h4>
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('assets/img/avatar.webp') }}" alt="user-avatar"
                                    class="d-block w-px-150 h-px-150 rounded" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" onclick="upload.focus" class="btn btn-primary me-2 mb-3" tabindex="0">
                                        <span class="d-none d-sm-block">Charger une photo ici</span>
                                        <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                        <input type="file" id="upload"
                                        name="admin_img" class="account-file-input" hidden onchange="previewFile()" accept="image/*" />
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
                                            <input class="form-control" type="text" placeholder="Votre nom" id="firstName" name="fname"
                                                autofocus />
                                            <label for="firstName">Nom</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" name="lname" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" id="email" name="email"
                                                placeholder="john.doe@example.com" />
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                                <select id="school" name="school" class="select2 form-select">
                                                    <option value="" selected disabled>Selectionnez une école</option>
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
                                                <input type="text" id="phoneNumber" name="phone" class="form-control"
                                                    placeholder="202 555 0111" />
                                                <label for="phoneNumber">Nº de téléphone</label>
                                            </div>
                                            <span class="input-group-text">CIV (+225)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Address" />
                                            <label for="address">Adresse de résidence</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" id="city" name="city"
                                                placeholder="Ville" />
                                            <label for="city">Ville</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="fonction" name="fonction"
                                                placeholder="Enseignant assistant" />
                                            <label for="fonction">Fonction</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="matricule" name="matricule"
                                                placeholder="2012993755JD" maxlength="10" />
                                            <label for="matricule">Matricule</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select id="role_id" name="role_id" class="select2 form-select">
                                                <option value="">Selectionnez le rôle</option>
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

                    <div class="card">
                        <h5 class="card-header fw-normal">Activé le compte</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading mb-1">Êtes-vous sûre de bien vouloir activé le compte?</h6>
                                    <p class="mb-0">Une fois que vous avez activé le compte, cet utilisateur pourra avoir accès à l'espace administration librement. Soyez assuré.</p>
                                </div>
                            </div>
                            <div id="formAccountDeactivation">
                                <div class="form-check mb-3 ms-3">
                                    <input class="form-check-input" type="checkbox" onchange="getValue()" name="accountActivation"
                                        id="accountActivation" />
                                    <label class="form-check-label" for="accountActivation">Je confirme l'activation de mon compte</label>
                                </div>
                            </div>
                            {{-- d-none --}}
                            <div class="col-md-6 mx-auto text-center d-none" id="password">
                                <div class="form-password-toggle">
                                    <h6 class="text-center text-warning mt-4">
                                        <i class="mdi mdi-bell-ring"></i>
                                        Veuillez saisir le mot de passe de l'activation du compte
                                    </h6>
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
    </div>

    <script>
        function getValue(){
            let password = document.querySelector('#password');
            const checkBox = document.getElementById('accountActivation').checked;
            if (checkBox === true) {
                password.classList.remove('d-none');
            } else {
                password.classList.add('d-none');
            }
        }

        function previewFile() {
            const preview = document.querySelector("#uploadedAvatar");
            const file = document.querySelector('#upload').files[0];
            const reader = new FileReader();

            reader.addEventListener(
                "load",
                () => {
                // convert image file to base64 string
                    preview.src = reader.result;
                },
                false,
            );

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
