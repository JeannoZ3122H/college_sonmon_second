@extends('main.admin_layout')
@section('title')
    Ajouter une inscription en informatique
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajout d'inscription en informatique /</span> nouvelle inscription en informatique</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h4 class="card-header">Nouvelle inscription en informatique</h4>

                    @if ($data)
                        <div class="card-body pt-2 mt-1">
                            <form id="formAccountSettings" method="POST"
                                action="{{ route('dashboard.inscription_computer_science_student_step_three', $data->id) }}">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-header">
                                                    <b class="ms-2 fst-italic">>></b>
                                                    Étape 2
                                                </h4>
                                            </div>
                                            <div class="card-body mx-5">
                                                <div id="go-to-content" class="row justify-content-center">
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control form-control-lg" type="text" id="fname"
                                                                name="fname" readonly value="{{ $data->fname }}" placeholder="..." autofocus />
                                                            <label for="fname">Nom</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control form-control-lg" type="text" id="lname"
                                                                name="lname" readonly value="{{ $data->lname }}" placeholder="..." autofocus />
                                                            <label for="lname">Prénoms</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control form-control-lg" type="text" id="matricule"
                                                                name="matricule" readonly value="{{ $data->matricule }}" placeholder="Entrer le matricule" autofocus />
                                                            <label for="matricule">Matricule</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input readonly value="{{ $data->classroom }}" class="form-control form-control-lg" type="text" id="classroom"
                                                                placeholder="..." autofocus />
                                                            <label for="classroom">Classe</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input readonly value="{{ $data->lieu_naissance }}" class="form-control form-control-lg" type="text" id="lieu_naissance"
                                                                placeholder="..." autofocus />
                                                            <label for="lieu_naissance">Lieu de naissance</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input readonly value="{{ $data->date_naissance }}" class="form-control form-control-lg" type="date" id="date_naissance"
                                                                placeholder="..." autofocus />
                                                            <label for="date_naissance">Date de naissance</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input readonly value="{{ $data->fullname_father }}" class="form-control form-control-lg"
                                                            type="text" id="fullname_father" placeholder="..." autofocus />
                                                            <label for="fullname_father">Nom complet du père</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-3 col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input readonly value="{{ $data->fullname_mather }}" class="form-control form-control-lg"
                                                            type="text" id="fullname_mather" placeholder="..." autofocus />
                                                            <label for="fullname_mather">Nom complet de la mère</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="send-to-content" class="row d-none justify-content-center">
                                                    <div class="card-header">
                                                        <h4 class="card-header">
                                                            <b class="ms-2 fst-italic"><></b>
                                                        Scolarités pour le niveau d'étude de l'élève
                                                        </h4>
                                                    </div>
                                                    @foreach ($liste_scolarites_computer_science as $item)
                                                        {{-- <div onclick="toggle()" style="cursor: pointer" class="col-lg-3 mb-3 col-md-4 col-12"> --}}
                                                        <div style="cursor: pointer" class="col-lg-3 card-content-selected mb-3 col-md-4 col-12">
                                                            <div class="card card-selected">
                                                                <div class="card-body">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-12">
                                                                            <input class="form-control form-control-lg" type="text" id="price"
                                                                                name="price" readonly value="{{ $item->price.'F CFA' }}" placeholder="..." />
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <input hidden class="form-control form-control-lg" type="text" id="id_price"
                                                                                name="id_price" readonly value="{{ $item->id }}" placeholder="..." />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input hidden class="form-control form-control-lg" type="text" id="school_year_start"
                                                                                name="school_year_start" readonly value="{{ $item->school_year_start }}" placeholder="..." />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input hidden class="form-control form-control-lg" type="text" id="school_year_end"
                                                                                name="school_year_end" readonly value="{{ $item->school_year_end }}" placeholder="..." />
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3 d-flex justify-content-center">
                                                                        <span class="badge text-bg-secondary">{{ $item->school_year_start }} <b class="mx-1">-</b> {{ $item->school_year_end }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="cursor: pointer" class="col-lg-3 card-content-selected mb-3 col-md-4 col-12">
                                                            <div class="card 1 card-selected">
                                                                <div class="card-body">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-12">
                                                                            <input class="form-control form-control-lg" type="text" id="price"
                                                                                name="price" readonly value="{{ $item->price.'F CFA' }}" placeholder="..." />
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <input hidden class="form-control form-control-lg" type="text" id="id_price"
                                                                                name="id_price" readonly value="{{ $item->id }}" placeholder="..." />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input hidden class="form-control form-control-lg" type="text" id="school_year_start"
                                                                                name="school_year_start" readonly value="{{ $item->school_year_start }}" placeholder="..." />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input hidden class="form-control form-control-lg" type="text" id="school_year_end"
                                                                                name="school_year_end" readonly value="{{ $item->school_year_end }}" placeholder="..." />
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3 d-flex justify-content-center">
                                                                        <span class="badge text-bg-secondary">{{ $item->school_year_start }} <b class="mx-1">-</b> {{ $item->school_year_end }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div id="go-to" class="text-center mt-3">
                                                    <button type="button" onclick="showContent()" class="btn btn-primary me-2">
                                                        <i class="mdi mdi-account-search me-2"></i>
                                                        confirmer
                                                    </button>
                                                </div>
                                                <div id="send-to" class="text-center d-none mt-3">
                                                    <button type="submit" class="btn btn-primary me-2">
                                                        <i class="mdi mdi-account-search me-2"></i>
                                                        Terminer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('dashboard.liste_computer_science_student') }}"
                                        class="btn btn-outline-danger me-2">
                                        Retour
                                    </a>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <script>
        let send_to = document.querySelector('#send-to');
        let go_to = document.querySelector('#go-to');

        let go_to_content = document.querySelector('#go-to-content');
        let send_to_content = document.querySelector('#send-to-content');

        function showContent(){
            go_to.classList.add('d-none');
            send_to.classList.remove('d-none');

            send_to_content.classList.remove('d-none');
            go_to_content.classList.add('d-none');
        }

        // let toggle_color = document.querySelectorAll('.card-content-selected');
        let toggle_color = document.querySelectorAll('.card-selected');
        toggle_color.forEach((element, index) => {
            element.addEventListener('click', function(e) {
                if(e.target){
                    // console.log(e.target); return
                    for (let i = 0; i < toggle_color.length; i++) {
                        if(i == index){
                            toggle_color[i].classList.add('border');
                            toggle_color[i].classList.add('border-2');
                            toggle_color[i].classList.add('border-success');
                        }else{
                            toggle_color[i].remove('border');
                            toggle_color[i].remove('border-2');
                            toggle_color[i].remove('border-success');
                        }
                    }
                }
            }, false);
        });
    </script>
@endsection
