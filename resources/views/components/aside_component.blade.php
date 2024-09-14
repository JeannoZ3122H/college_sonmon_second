<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link mt-3">
            <span class="app-brand-logo demo me-1" style="width: 50px !important">
                <span style="color: var(--bs-primary)" style="width: 50px !important">
                    {{-- <svg width="30" height="24" viewBox="0 0 250 196" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                            fill="currentColor" />
                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                            d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                            d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                            fill="currentColor" />
                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                            d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />
                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                            d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                            fill="white" fill-opacity="0.15" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                            fill="white" fill-opacity="0.3" />
                    </svg> --}}
                    <img src="{{ asset('assets/img/logo.png') }}" style="width: 90% !important" class="img-fluid"
                        alt="">
                </span>
            </span>
            <span style="max-width: 220px !important"
            class="app-brand-text demo text-wrap menu-text lh-sm fw-semibold ms-2 fs-6 text-small">
               {{ $_user->school }}
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-2">
        <!-- Dashboards -->
        <li class="{{ Route::is('index')?'menu-item active':'menu-item' }}">
            <a href="{{ route('index') }}" class="menu-link ">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboards">Tableau de bord</div>
            </a>
        </li>

        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-flip-to-front"></i>
                <div data-i18n="Front Pages">Front Pages</div>
                <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                        class="menu-link" target="_blank">
                        <div data-i18n="Landing">Landing</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                        class="menu-link" target="_blank">
                        <div data-i18n="Pricing">Pricing</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/payment-page.html"
                        class="menu-link" target="_blank">
                        <div data-i18n="Payment">Payment</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/checkout-page.html"
                        class="menu-link" target="_blank">
                        <div data-i18n="Checkout">Checkout</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/help-center-landing.html"
                        class="menu-link" target="_blank">
                        <div data-i18n="Help Center">Help Center</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Écoles &amp; Fontionnalités</span>
        </li>
        <!-- Apps -->
        <li class="{{ Route::is('dashboard.inscription_student_step_one')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.inscription_student_step_one') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-view-grid-outline"></i>
                <div data-i18n="Email">Onglets (inscriptions)</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.informations')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.informations') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-message-outline"></i>
                <div data-i18n="Chat">Informations</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.bilan_financier_content')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.bilan_financier_content') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-monitor-dashboard"></i>
                <div data-i18n="Calendar">Bilan Financiers</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.infos_caisse_jour')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.infos_caisse_jour') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-book-information-variant"></i>
                <div data-i18n="Kanban">Infos caisse jour</div>
            </a>
        </li>
        <!-- Pages -->
        <li class="{{ Route::is('dashboard.situation_tresor')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.situation_tresor') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cash-multiple"></i>
                <div data-i18n="Account Settings">Situation trésor</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.liste_expense_journal')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.liste_expense_journal') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cash-100"></i>
                <div data-i18n="Authentications">Journal des dépenses</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.liste_other_expense_journal')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.liste_other_expense_journal') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cash-register"></i>
                <div data-i18n="Misc">Autres entrées caisse</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.liste_construction_expense_journal')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.liste_construction_expense_journal') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-city-outline"></i>
                <div data-i18n="Account Settings">Constructions</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.liste_movement_bank')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.liste_movement_bank') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-credit-card-fast-outline"></i>
                <div data-i18n="Authentications">Mouvements bancaire</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.liste_computer_science_student')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.liste_computer_science_student') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-desktop-classic"></i>
                <div data-i18n="Authentications">Informatiques</div>
            </a>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Classes &amp; Scolarités</span></li>
        <!-- Cards -->
        <li class="{{ Route::is('dashboard.liste_student')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.liste_student') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-account-multiple-plus"></i>
                <div data-i18n="Basic">Liste inscriptions</div>
            </a>
        </li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-google-classroom"></i>
                <div data-i18n="User interface">Classes</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.add_classroom') }}" class="menu-link">
                        <div data-i18n="Accordion">Ajouter une classe</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dashboard.liste_classroom') }}" class="menu-link">
                        <div data-i18n="Alerts">Listes</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Extended components -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-cash-sync"></i>
                <div data-i18n="Extended UI">Scolarités informatique</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.add_scolarites_computer_science') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Ajouter</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dashboard.liste_scolarites_computer_science') }}" class="menu-link">
                        <div data-i18n="Text Divider">Listes</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Extended components -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-cash-sync"></i>
                <div data-i18n="Extended UI">Scolarités</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.add_scolarite') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Ajouter une scolarités</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dashboard.liste_scolarite') }}" class="menu-link">
                        <div data-i18n="Text Divider">Listes</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-google-classroom"></i>
                <div data-i18n="User interface">Niveau d'étude</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.add_niveau_etude') }}" class="menu-link">
                        <div data-i18n="Accordion">Ajouter un niveau</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dashboard.liste_niveau_etude') }}" class="menu-link">
                        <div data-i18n="Alerts">Listes</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Paramètres du site</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-account-key"></i>
                <div data-i18n="Form Elements">Comptes admin</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.add_admin_account') }}" class="menu-link">
                        <div data-i18n="Basic Inputs">Ajouter un compte </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dashboard.liste_admin_account') }}" class="menu-link">
                        <div data-i18n="Input groups">Liste des comptes</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-school"></i>
                <div data-i18n="Form Layouts">Écoles</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.add_school') }}" class="menu-link">
                        <div data-i18n="Basic Inputs">Ajouter une école </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dashboard.liste_school') }}" class="menu-link">
                        <div data-i18n="Input groups">Liste des écoles</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-gesture-tap"></i>
                <div data-i18n="Form Layouts">Rôles</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.add_role') }}" class="menu-link">
                        <div data-i18n="Basic Inputs">Ajouter un rôle </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dashboard.liste_role') }}" class="menu-link">
                        <div data-i18n="Input groups">Liste des rôles</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Analytiques</span></li>
        <li class="{{ Route::is('dashboard.list_statistiques')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.list_statistiques') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-google-analytics"></i>
                <div data-i18n="Support">Statistiques</div>
            </a>
        </li>
        <li class="{{ Route::is('dashboard.list_historic')?'menu-item active':'menu-item' }}">
            <a href="{{ route('dashboard.list_historic') }}"class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="Documentation">Historiques</div>
            </a>
        </li>
    </ul>
</aside>
