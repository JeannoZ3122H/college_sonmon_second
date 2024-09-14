@extends('main.admin_layout')
@section('title')
Faire une inscription
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-kanban">
        <!-- Add new board -->
        <div class="row">
            <div class="col-12">
                <h6 class="text-muted">
                    Faire une inscription
                    <i class="menu-icon tf-icons ms-2 mdi mdi-account-multiple-plus"></i>
                </h6>
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist" id="steppers">
                        <li class="nav-item mx-2" role="presentation">
                            <button id="step_2" type="button" class="nav-link btn-stepper waves-effect waves-light active" disabled role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile"
                                aria-controls="navs-pills-justified-profile" aria-selected="false" tabindex="-1">
                                <i class="menu-icon tf-icons ms-2 mdi mdi-account-multiple-plus"></i>
                                Étape 3
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="tab-content">

                        <div class="tab-pane tabs-blocs fade active show" id="navs-pills-justified-profile" role="tabpanel">
                            <h2 class="text-center my-1">Formulaire d'inscription</h2>
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-12">
                                    <form class="row justify-content-center g-3" action="{{ route('dashboard.inscription_student_step_four', $id) }}"
                                    id="forms" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <hr class="my-1">
                                        <h4 class="text-center my-1">
                                            <i class="mdi mdi-file text-warning me-2"></i>
                                            Information sur l'élève
                                        </h4>
                                        <hr class="my-1">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="fname" id="fname"
                                                placeholder="Entrer le nom" >
                                                <label for="fname">Nom de l'élève</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="lname"
                                                placeholder="Entrer le prénoms" name="lname">
                                                <label for="lname">Prénoms de l'élève</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="date_naissance"
                                                placeholder="Entrer la date de naissance" name="date_naissance">
                                                <label for="date_naissance">Date de naissance</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="lieu_naissance"
                                                placeholder="Entrer le lieu de naissance" name="lieu_naissance">
                                                <label for="lieu_naissance">lieu de naissance</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="matricule"
                                                placeholder="Entrer le matricule de l'élève" name="matricule">
                                                <label for="matricule">Matricule de l'élève</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="fullname_father" id="fullname_father"
                                                placeholder="Entrer le nom complet" >
                                                <label for="fullname_father">Nom et prénoms du père</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="fullname_mather"
                                                placeholder="Entrer le nom complet" name="fullname_mather">
                                                <label for="fullname_mather">Nom et prénoms de la mère</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control" id="emergency_phone"
                                                placeholder="(+225) 0101010101" name="emergency_phone">
                                                <label for="emergency_phone">Numéro à contacter en cas d'urgence</label>
                                            </div>
                                        </div>
                                        <hr class="mb-1 mt-4">

                                        @if($data_scolarite)
                                            <h4 class="text-center my-1">
                                                <i class="mdi mdi-account-cash me-2 text-warning"></i>
                                                Information sur la scolarité</h4>
                                            <hr class="my-1">
                                            <div class=" col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                <h4>Scolarité:
                                                                    <span class="ms-3 text-danger fw-bolder">{{ $data_scolarite->price.'F CFA' }}</span>
                                                                </h4>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h4>Niveau d'étude:
                                                                    <span class="ms-3 fw-bolder">{{ $data_scolarite->niveau_etude }}</span>
                                                                </h4>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h4>Année de scolaire:
                                                                    <span class="ms-3 fw-bolder">
                                                                        {{ $data_scolarite->school_year_start.'-'.$data_scolarite->school_year_end }}
                                                                    </span>
                                                                </h4>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="my-3 text-center">
                                            <button type="submit" class="btn btn-primary" onclick="getLocalStorageData()">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .fs-big{
        font-size: 5.875rem !important;
    }
    .text-green{
        color: #249441 !important;
    }
</style>

<script>

    function getValue(n){
        let convert = JSON.parse(n);
        document.querySelector('#show-niv').innerHTML = convert.niveau_etude;
        document.querySelector('#scolarite').innerHTML = convert.price+' '+' F CFA';
        document.querySelector('#school_year').innerHTML = convert.school_year_start+'-'+convert.school_year_end;
        document.querySelector('#cll').innerHTML = 'Collège somon de konahiri';

        let data = JSON.parse(n);
        localStorage.setItem('scolarite', JSON.stringify(data));
    }

    function removeActive(){
        let buttonList = document.querySelectorAll(".btn-toggle");
        let info_bloc = document.querySelector('#info-bloc');
        let info_btn = document.querySelector('#info-btn');
        let scolarite_bloc = document.querySelectorAll('#scolarite-bloc');
        let icon_show = document.querySelectorAll('.btn-toggle .tf-icons');

        info_btn.classList.add('d-none');
        info_bloc.classList.add('d-none');

        buttonList.forEach((el) => {
            el.classList.remove('disabled');
            el.classList.add('btn-label-primary');
            el.classList.remove('btn-primary');
        });

        scolarite_bloc.forEach((el) => {
            el.classList.remove('d-none');
        });

        icon_show.forEach((el) => {
            el.classList.add('d-none');
        });

    }

    function toggleActive(event) {
        let target = event.target || event.srcElement;
        let buttonList = document.querySelectorAll(".btn-toggle");
        let icon_show = document.querySelector('.btn-toggle .tf-icons');

        let info_bloc = document.querySelector('#info-bloc');
        let info_btn = document.querySelector('#info-btn');
        let scolarite_bloc = document.querySelectorAll('#scolarite-bloc');
        // console.log(target); return
        buttonList.forEach(function(button) {

            info_bloc.classList.remove('d-none');
            info_btn.classList.remove('d-none');

                if (button === target && !button.classList.contains("btn-primary")) {

                    button.id = "on";
                    let scolarite_target = document.querySelector("#on");
                    let icon_target = document.querySelector("#on .tf-icons");
                    scolarite_target.classList.remove('btn-label-primary');
                    scolarite_target.classList.add('btn-primary');
                    scolarite_target.classList.add('disabled');
                    icon_target.classList.toggle('d-none');

                }else{

                    scolarite_bloc.forEach((elt) => {
                        if (elt === target && !elt.classList.contains("btn-primary")) {
                            elt.classList.remove('d-none');
                        }else{
                            elt.classList.add('d-none');
                        }
                    });

                    button.id = "off";
                    setTimeout(() => {
                        let scolarite_no_target = document.querySelectorAll("#off");
                        let icon_no_target = document.querySelectorAll("#off .tf-icons");
                        scolarite_no_target.forEach(element => {
                            element.classList.add('btn-label-primary');
                            element.classList.remove('btn-primary');
                        });
                        icon_no_target.forEach(element => {
                            element.classList.add('d-none');
                        });
                    }, 200);

                }
            }
        )
    }

    function goToNextStep(){
        let add_attr = document.querySelectorAll('#steppers .btn-stepper')
        let active_nav_item = document.querySelector('#steppers .nav-item .active')

        let tab_content_elts = document.querySelectorAll('#tab-content .tabs-blocs')
        let tab_bloc_active = document.querySelector('#tab-content .tabs-blocs .active.show')

        let len = add_attr.length;
        let len_tabs = tab_content_elts.length;

        for(let i = 0; i < add_attr.length;i++)
        {
            if(add_attr[i].classList.contains("active"))
            {
                let _next = add_attr[i + 1];

                if(_next){
                    _next.ariaSelected = "true";
                    _next.removeAttribute('tabindex');
                    _next.classList.add('active');
                    _next.removeAttribute('disabled');
                }else if(add_attr[i] != _next){

                    add_attr[i].ariaSelected = "false";
                    add_attr[i].setAttribute('tabindex', -1);
                    add_attr[i].classList.remove('active');
                    add_attr[i].setAttribute('disabled', true);

                }
            }
        }

        for(let i = 0; i < 1;i++)
        {
            let _next_bloc = tab_content_elts[i + 1];

            if(tab_content_elts[i].classList.contains("active")
            && tab_content_elts[i].classList.contains("show"))
            {
                let _next_bloc = tab_content_elts[i + 1];

                _next_bloc.classList.remove('fade');
                _next_bloc.classList.add('active');
                _next_bloc.classList.add('show');

                tab_content_elts[i].classList.remove('active');
                tab_content_elts[i].classList.remove('show');
                tab_content_elts[i].classList.add('fade');

                let text_data = localStorage.getItem('scolarite');


                let input_1 = document.querySelector('#_scolarite');
                let input_2 = document.querySelector('#_niveau_etude');
                let input_3 = document.querySelector('#_school_year_end');
                let input_4 = document.querySelector('#_school_year_start');
                let input_0 = document.querySelector('#id_scolarite');

                let data = JSON.parse(text_data);
                // console.log(data.niveau_etude_id); return
                input_1.setAttribute('value', data.price);
                input_2.setAttribute('value', data.niveau_etude_id);
                input_3.setAttribute('value', data.school_year_end);
                input_4.setAttribute('value', data.school_year_start);

                input_0.setAttribute('value', data.id)

            }
            if(!tab_content_elts[i].classList.contains("active")
            && !tab_content_elts[i].classList.contains("show")){

                tab_content_elts[i].classList.remove('active');
                tab_content_elts[i].classList.remove('show');
                tab_content_elts[i].classList.add('fade');

            }
        }
    }

</script>
@endsection
