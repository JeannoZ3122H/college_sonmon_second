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
                            <button id="step_1" type="button" class="nav-link btn-stepper waves-effect waves-light active" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home"
                                aria-controls="navs-pills-justified-home" aria-selected="true">
                                <i class="tf-icons mdi mdi-book-information-variant me-1"></i>
                                Étape 1
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="tab-content">
                        <div class="tab-pane tabs-blocs fade active show" id="navs-pills-justified-home" role="tabpanel">
                            <div class="row justify-content-center">
                                @foreach ($liste_scolarite as $item)
                                    <div class="col-lg-4 col-md-6 col-12" id="scolarite-bloc">
                                        <form action="{{ route('dashboard.inscription_student_step_two', [$item->id, $item->niveau_etude]) }}" method="post">
                                            @csrf
                                            <div class="card text-center m-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Je fais mon inscription</h5>
                                                    <p class="card-text"><i class="mdi mdi-book-open-page-variant fs-1"></i></p>
                                                    <button type="submit" class="btn border btn-toggle btn-label-primary waves-effect">
                                                        <span class="tf-icons mdi d-none mdi-checkbox-marked-circle-outline me-3"></span>
                                                        {{ $item->niveau_etude }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
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
@endsection
