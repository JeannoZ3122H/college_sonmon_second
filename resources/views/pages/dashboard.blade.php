@extends('main.admin_layout')
@section('title')
    Accueil
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4">
            <!-- Congratulations card -->
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-1">
                            Bienvenue <br>
                            <small>
                            {{ $_user->fname.' '.$_user->lname }}</small>! 🎉
                        </h4>
                        <p class="mt-3">
                            <span class="fs-1 mt-auto text-dark ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="dark" class="bi bi-calendar4-event" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                    <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                {{ strftime("%d", strtotime(\Carbon\Carbon::now())) }}
                            </span>
                            <span class="fs-7 mt-auto ms-auto">
                                {{ \Carbon\Carbon::now()->format('/m/Y') }}
                            </span>
                        </p>
                        {{-- <p class="pb-0">Best seller of the month</p>
                        <h4 class="text-primary mb-1">$42.8k</h4>
                        <p class="mb-2 pb-1">78% of target 🚀</p>
                        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> --}}
                    </div>
                    {{-- <img src="../assets/img/icons/misc/triangle-light.png"
                        class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background"
                        data-app-light-img="icons/misc/triangle-light.png"
                        data-app-dark-img="icons/misc/triangle-dark.png" />
                    <img src="../assets/img/illustrations/trophy.png"
                        class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales" /> --}}
                </div>
            </div>
            <!--/ Congratulations card -->

            <!-- Transactions -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Détails de transactions</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" role="button" onclick="window.location.reload();">Actualiser</a>
                                    <a class="dropdown-item" href="{{ route('dashboard.list_statistiques') }}">Voir plus</a>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3">
                            <small class="fw-medium">Total de dépense pour le mois actuel</small>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-primary rounded shadow">
                                            <i class="mdi mdi-trending-up mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Sales</div>
                                        <h5 class="mb-0">245k</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-success rounded shadow">
                                            <i class="mdi mdi-account-outline mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Customers</div>
                                        <h5 class="mb-0">12.5k</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-warning rounded shadow">
                                            <i class="mdi mdi-cellphone-link mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Product</div>
                                        <h5 class="mb-0">1.54k</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-info rounded shadow">
                                            <i class="mdi mdi-currency-usd mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Revenue</div>
                                        <h5 class="mb-0">$88k</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-2">
            <!-- Data Tables -->
            <div class="col-12">
                <div class="text-start">
                    <h4 class=""><span class="text-muted fw-light">Liste des comptes administrateurs</span></h4>
                </div>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-truncate">Administrateur</th>
                                    <th class="text-truncate">Role</th>
                                    <th class="text-truncate">Fonction</th>
                                    <th class="text-truncate">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_admin as $person)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <img src="{{ $person->admin_img }}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-truncate">{{ $person->fname.' '.$person->lname }}</h6>
                                                    <small class="text-truncate">{{ $person->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">
                                            <i class="mdi mdi-laptop mdi-24px text-danger me-1"></i> {{ $person->role }}
                                        </td>
                                        <td class="text-truncate">{{ $person->fonction }}</td>
                                        <td>
                                            <span class="{{ $person->status_account == 0?'badge bg-label-danger rounded-pill':'badge bg-label-success rounded-pill' }}">{{ $person->status_account == 1?'Actif':'Inactif' }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Data Tables -->
        </div>
    </div>
@endsection
