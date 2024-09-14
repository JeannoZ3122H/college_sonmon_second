<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Auhtentification</title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords"
        content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/item/materio-bootstrap-html-admin-template/">

    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5DDHKGP');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0"
            style="display: none; visibility: hidden">
        </iframe>
    </noscript>

    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="index.html" class="auth-cover-brand d-flex align-items-center gap-2">
            <span class="app-brand-logo demo me-1" style="width: 50px !important">
                <span style="color: var(--bs-primary)" style="width: 50px !important">
                    <img src="{{ asset('assets/img/logo.png') }}" style="width: 90% !important" class="img-fluid"
                        alt="">
                </span>
            </span>
            <span class="app-brand-text demo text-heading fw-semibold">Collège sonmon</span>
        </a>

        @if (request()->route()->uri == 'auth')
            <div class="authentication-inner row m-0">
                <!-- /Left Section -->
                <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
                    <div>
                        <img src="{{ asset('assets/img/login.png') }}"
                            class="authentication-image-model d-none d-lg-block w-75" alt="auth-model"
                            data-app-light-img="illustrations/girl-verify-password-light.png"
                            data-app-dark-img="illustrations/girl-verify-password-dark.png">
                    </div>
                    <img src="{{ asset('assets/img/illustrations/auth-cover-mask-light.png') }}"
                        class="scaleX-n1-rtl authentication-image d-none d-lg-block w-75" alt="triangle-bg"
                        data-app-light-img="illustrations/auth-cover-mask-light.png"
                        data-app-dark-img="illustrations/auth-cover-mask-dark.png">
                </div>
                <!-- /Left Section -->
                <!-- Login -->
                <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
                    <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                        <h4 class="mb-2">Bienvenue au collège sonmon! 👋 </h4>
                        <p class="mb-4">Veuillez vous connecter à votre compte et commencer l'aventure</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('authentification') }}"
                            method="POST">
                            @csrf
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Entrer votre email" autofocus>
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" class="form-control" name="password"
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
                            <div class="mb-3 d-flex justify-content-between flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" onchange="getVal()" type="checkbox"
                                        id="remember-me">
                                    <label class="form-check-label me-2" for="remember-me">
                                        Se rapeller de moi
                                    </label>
                                </div>
                                <a href="{{ route('forget_password') }}" class="float-end mb-1">
                                    <span>Mot de passe oublié?</span>
                                </a>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100" onchange="getVal()">
                                Se connecter
                            </button>
                        </form>

                        <div class="divider my-4">
                            <div class="divider-text">Nos réseaux sociaux</div>
                        </div>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                                <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                                <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                                <i class="tf-icons mdi mdi-24px mdi-github"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                                <i class="tf-icons mdi mdi-24px mdi-google"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        @elseif(request()->route()->uri == 'forget_password')
            <div class="authentication-inner row m-0">
                <!-- /Left Section -->
                <div class="d-none d-lg-flex col-xl-5 align-items-center justify-content-center p-5 pb-2">
                    <div>
                        <img src="{{ asset('assets/img/forgot_password.png') }}"
                            class="authentication-image-model d-none d-lg-block w-100" alt="auth-model"
                            data-app-light-img="illustrations/girl-verify-password-light.png"
                            data-app-dark-img="illustrations/girl-verify-password-dark.png">
                    </div>
                    <img src="{{ asset('assets/img/illustrations/auth-cover-mask-light.png') }}"
                        class="scaleX-n1-rtl authentication-image d-none d-lg-block w-75" alt="triangle-bg"
                        data-app-light-img="illustrations/auth-cover-mask-light.png"
                        data-app-dark-img="illustrations/auth-cover-mask-dark.png">
                </div>

                <div class="d-flex col-12 col-lg-7 flex-wrap justify-content-center
                col-xl-7 align-items-center authentication-bg position-relative py-sm-5 py-4">
                    <div class="text-center m-2 w-75">
                        <h5 class="card-title text-uppercase m-3">Mot de passe oublié?</h5>
                        <hr>
                        <form id="formAuthentication" class="mb-3" action="{{ route('forget_password_email_verify') }}"
                            method="POST">
                            @csrf
                            <div class="card mb-3 w-100">
                                <div class="card-body p-2">
                                    <div class="form-floating form-floating-outline my-3">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Entrer votre email" autofocus>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-2">
                                <button type="submit" class="btn btn-lg btn-primary">Vérifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @elseif(request()->route()->uri == 'new_password')
            <div class="authentication-inner row m-0">
                <!-- /Left Section -->
                <div class="d-none d-lg-flex col-xl-5 align-items-center justify-content-center p-5 pb-2">
                    <div>
                        <img src="{{ asset('assets/img/forgot_password.png') }}"
                            class="authentication-image-model d-none d-lg-block w-100" alt="auth-model"
                            data-app-light-img="illustrations/girl-verify-password-light.png"
                            data-app-dark-img="illustrations/girl-verify-password-dark.png">
                    </div>
                    <img src="{{ asset('assets/img/illustrations/auth-cover-mask-light.png') }}"
                        class="scaleX-n1-rtl authentication-image d-none d-lg-block w-75" alt="triangle-bg"
                        data-app-light-img="illustrations/auth-cover-mask-light.png"
                        data-app-dark-img="illustrations/auth-cover-mask-dark.png">
                </div>

                <div class="d-flex col-12 col-lg-7 flex-wrap justify-content-center
                col-xl-7 align-items-center authentication-bg position-relative py-sm-5 py-4">
                    <div class="text-center m-2 w-75">
                        <h5 class="card-title text-uppercase m-3">Nouveau mot de passe</h5>
                        <hr>
                        <form id="formAuthentication" class="mb-3" action="{{ route('forget_password_reset') }}"
                            method="POST">
                            @csrf
                            <div class="card mb-3 p-2 w-100">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-password-toggle">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input oninput="newPassword(this.value)" type="password" id="new_password" class="form-control" name="new_password"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="new_password" />
                                                    <label for="new_password">Mot de passe</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer">
                                                    <i class="mdi mdi-eye-off-outline"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <p class="card-text d-none" id="check_new_password"><small class="text-danger">Veuillez saisir un mot de passe de minimum <b>(6) caractères</b></small></p>
                                    </div>
                                    <div class="mb-0">
                                        <div class="form-password-toggle">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input oninput="newConfirmation(this.value)" type="password" id="confirmation" class="form-control" name="confirmation"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="confirmation" />
                                                    <label for="confirmation">Confirmation</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer">
                                                    <i class="mdi mdi-eye-off-outline"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <p class="card-text d-none" id="check_confirmation"><small class="text-danger">Mot de passe non identique</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-2">
                                <button type="submit" class="btn btn-lg btn-primary">Changer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- / Content -->
    <div class="buy-now">
        <a href="{{ route('auth') }}" class="btn btn-danger btn-buy-now">
            Retour
        </a>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>

    <script>
        // input
        let inpNewPassword = '';
        let inpConfirmation = '';
        // bloc error
        let blocNewPassword = document.querySelector('#check_new_password');
        let blocConfirmation = document.querySelector('#check_confirmation');

        function newPassword(e){
            inpNewPassword = e;
            if(e.length < 6 && e.length != 0){
                blocNewPassword.classList.remove('d-none');
            }else{
                blocNewPassword.classList.add('d-none');
            }
        }
        function newConfirmation(e){
            if(inpNewPassword != e && e.length != 0){
                blocConfirmation.classList.remove('d-none');
            }else{
                blocConfirmation.classList.add('d-none');
            }
        }


        let getData = localStorage.getItem('old_data');

        if ((getData != null) || (getData != undefined)) {
            let data = JSON.parse(getData);
            let inp_password = document.querySelector('#password');
            let inp_email = document.querySelector('#email');
            let inp_checkbox = document.getElementById('remember-me');

            inp_email.setAttribute('value', data.email);
            inp_password.setAttribute('value', data.password);
            inp_checkbox.setAttribute('checked', 'checked');
        } else {

        }

        function getVal() {
            const password = document.querySelector('#password').value;
            const email = document.querySelector('#email').value;

            const checkBox = document.getElementById('remember-me').checked;
            if (checkBox === true) {
                const data = {
                    email: email,
                    password: password
                };
                localStorage.setItem('old_data', JSON.stringify(data));
            } else {
                localStorage.removeItem('old_data');
            }
        }
    </script>
</body>

</html>
