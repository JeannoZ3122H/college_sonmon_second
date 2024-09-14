@extends('main.admin_layout')
@section('title')
Statistiques
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Statistiques</span></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow p-2 mb-4">
                <div class="col-12">

                    <!-- Transactions -->
                    <div class="col-12 my-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-title m-0 me-2">Finances statistiques</h5>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                            <a class="dropdown-item" role="button" onclick="window.location.reload();">Actualiser</a>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3"><span class="fw-medium">Total 48.5% growth</span> 😎 this month</p>
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
                                                <div class="small mb-1">Scolarité</div>
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
                                                <div class="small mb-1">Scolarité informatique</div>
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
                                                <div class="small mb-1">Classes</div>
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
                                                <div class="small mb-1">Total élèves</div>
                                                <h5 class="mb-0">$88k</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Four Cards -->
                    <div class="col-xl-12 col-md-12">
                        <div class="row gy-4">
                            <!-- Total Profit line chart -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header pb-0">
                                        <h4 class="mb-0">$86.4k</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="totalProfitLineChart" class="mb-3"></div>
                                        <h6 class="text-center mb-0">Total en caisse</h6>
                                    </div>
                                </div>
                            </div>
                            <!--/ Total Profit line chart -->
                            <!-- Total Profit Weekly Project -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-secondary rounded-circle shadow">
                                                <i class="mdi mdi-poll mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="totalProfitID" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mt-mg-1">
                                        <h6 class="mb-2">Situation trésor</h6>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                            <h4 class="mb-0 me-2">$25.6k</h4>
                                            <small class="text-success mt-1">+42%</small>
                                        </div>
                                        <small>Weekly Project</small>
                                    </div>
                                </div>
                            </div>
                            <!--/ Total Profit Weekly Project -->
                            <!-- New Yearly Project -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                                                <i class="mdi mdi-wallet-travel mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mt-mg-1">
                                        <h6 class="mb-2">Bilan financier</h6>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                            <h4 class="mb-0 me-2">862</h4>
                                            <small class="text-danger mt-1">-18%</small>
                                        </div>
                                        <small>Yearly Project</small>
                                    </div>
                                </div>
                            </div>
                            <!--/ New Yearly Project -->
                            <!-- Sessions chart -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                                                <i class="mdi mdi-wallet-travel mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mt-mg-1">
                                        <h6 class="mb-2">Mouvement bancaire</h6>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                            <h4 class="mb-0 me-2">862</h4>
                                            <small class="text-danger mt-1">-18%</small>
                                        </div>
                                        <small>Yearly Project</small>
                                    </div>
                                </div>
                            </div>
                            <!--/ Sessions chart -->
                            <!-- Total Profit line chart -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                                                <i class="mdi mdi-wallet-travel mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mt-mg-1">
                                        <h6 class="mb-2">Constructions</h6>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                            <h4 class="mb-0 me-2">862</h4>
                                            <small class="text-danger mt-1">-18%</small>
                                        </div>
                                        <small>Yearly Project</small>
                                    </div>
                                </div>
                            </div>
                            <!--/ Total Profit line chart -->
                            <!-- Total Profit Weekly Project -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-secondary rounded-circle shadow">
                                                <i class="mdi mdi-poll mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="totalProfitID" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mt-mg-1">
                                        <h6 class="mb-2">Info caisse</h6>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                            <h4 class="mb-0 me-2">$25.6k</h4>
                                            <small class="text-success mt-1">+42%</small>
                                        </div>
                                        <small>Weekly Project</small>
                                    </div>
                                </div>
                            </div>
                            <!--/ Total Profit Weekly Project -->
                            <!-- New Yearly Project -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                                                <i class="mdi mdi-wallet-travel mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mt-mg-1">
                                        <h6 class="mb-2">Journal de dépense</h6>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                            <h4 class="mb-0 me-2">862</h4>
                                            <small class="text-danger mt-1">-18%</small>
                                        </div>
                                        <small>Yearly Project</small>
                                    </div>
                                </div>
                            </div>
                            <!--/ New Yearly Project -->
                            <!-- Sessions chart -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                                                <i class="mdi mdi-wallet-travel mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mt-mg-1">
                                        <h6 class="mb-2">Autres entrée en caisse</h6>
                                        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                            <h4 class="mb-0 me-2">862</h4>
                                            <small class="text-danger mt-1">-18%</small>
                                        </div>
                                        <small>Yearly Project</small>
                                    </div>
                                </div>
                            </div>
                            <!--/ Sessions chart -->
                        </div>
                    </div>
                    <!--/ Total Earning -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
