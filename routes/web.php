<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.dashboard');
// });

Route::get('/', function () {
    return redirect()->route('index');
});

//🏀 CONNEXION ZONE //
Route::controller(AuthController::class)
// START \\
->group(function () {
    Route::post('/authentification', 'authentification')->name('authentification');
    Route::get('/logout/{id}', 'logOut')->name('logOut');
    Route::post('/forget_password_email_verify', 'forget_password_email_verify')->name('forget_password_email_verify');
    Route::post('/forget_password_reset', 'forget_password_reset')->name('forget_password_reset');
});
//🏀 END CONNEXION ZONE //


//🏀 CONNEXION PAGE ZONE //
Route::controller(AdminController::class)
// START \\
->group(function () {
    Route::get('/auth', 'auth')->name('login');
    Route::get('/forget_password', 'forget_password')->name('forget_password');
    Route::get('/new_password', 'forget_password')->name('new_password');
});
//🏀 END CONNEXION PAGE ZONE //


//🏀 REQUEST ZONE //
Route::controller(AdminController::class)
->middleware('auth')
// START \\
->group(function () {
    Route::get('/Welcome', 'dashboard')->name('index');
    Route::get('/Profile', 'profile')->name('dashboard.profile');

/*/ ❌ School Request ❌ /*/
    Route::get('/Ajouter.une.école', 'add_new_school_page')->name('dashboard.add_school');
    Route::post('/add_new_school_request', 'add_new_school_request')->name('dashboard.add_school_request');
    Route::get('/Modifier.une.école/{id}', 'edit_new_school')->name('dashboard.edit_school');
    Route::post('/update_new_school_request/{id}', 'update_school_request')->name('dashboard.update_school_request');
    Route::get('/delete_new_school_request/{id}', 'delete_new_school')->name('dashboard.delete_new_school');
    Route::get('/Liste.école', 'liste_school')->name('dashboard.liste_school');
/*/ ❌ School Request ❌ /*/

/*/ ❌ Role Request ❌ /*/
    Route::get('/Ajouter.un.rôle', 'add_new_role_page')->name('dashboard.add_role');
    Route::post('/add_new_role_request', 'add_new_role_request')->name('dashboard.add_role_request');
    Route::get('/Modifier.un.rôle/{id}', 'edit_new_role')->name('dashboard.edit_role');
    Route::post('/update_new_role_request/{id}', 'update_role_request')->name('dashboard.update_role_request');
    Route::get('/delete_new_role_request/{id}', 'delete_new_role')->name('dashboard.delete_new_role');
    Route::get('/Liste.rôle', 'liste_role')->name('dashboard.liste_role');
/*/ ❌ Role Request ❌ /*/

/*/ ❌ Classe Request ❌ /*/
    Route::get('/Ajouter.une.classe', 'add_new_classroom_page')->name('dashboard.add_classroom');
    Route::post('/add_new_classroom_request', 'add_new_classroom_request')->name('dashboard.add_classroom_request');
    Route::get('/Modifier.une.classe/{id}', 'edit_new_classroom')->name('dashboard.edit_classroom');
    Route::post('/update_new_classroom_request/{id}', 'update_classroom_request')->name('dashboard.update_classroom_request');
    Route::get('/delete_new_classroom_request/{id}', 'delete_new_classroom')->name('dashboard.delete_new_classroom');
    Route::get('/Liste.classe', 'liste_classroom')->name('dashboard.liste_classroom');
/*/ ❌ Classe Request ❌ /*/

/*/ ❌ Scolarite Request ❌ /*/
    Route::get('/Ajouter.une.scolarite', 'add_new_scolarite_page')->name('dashboard.add_scolarite');
    Route::post('/add_new_scolarite_request', 'add_new_scolarite_request')->name('dashboard.add_scolarite_request');
    Route::get('/Modifier.une.scolarite/{id}', 'edit_new_scolarite')->name('dashboard.edit_scolarite');
    Route::post('/update_new_scolarite_request/{id}', 'update_scolarite_request')->name('dashboard.update_scolarite_request');
    Route::get('/delete_new_scolarite_request/{id}', 'delete_new_scolarite')->name('dashboard.delete_new_scolarite');
    Route::get('/Liste.scolarite', 'liste_scolarite')->name('dashboard.liste_scolarite');
/*/ ❌ Scolarite Request ❌ /*/

/*/ ❌ Niveau Etude Request ❌ /*/
    Route::get('/Ajouter.un.niveau.etude', 'add_new_niveau_etude_page')->name('dashboard.add_niveau_etude');
    Route::post('/add_new_niveau_etude_request', 'add_new_niveau_etude_request')->name('dashboard.add_niveau_etude_request');
    Route::get('/Modifier.un.niveau.etude/{id}', 'edit_new_niveau_etude')->name('dashboard.edit_niveau_etude');
    Route::post('/update_new_niveau_etude_request/{id}', 'update_niveau_etude_request')->name('dashboard.update_niveau_etude_request');
    Route::get('/delete_new_niveau_etude_request/{id}', 'delete_new_niveau_etude')->name('dashboard.delete_new_niveau_etude');
    Route::get('/Liste.niveau.etude', 'liste_niveau_etude')->name('dashboard.liste_niveau_etude');
/*/ ❌ Niveau Etude Request ❌ /*/

/*/ ❌ Account Request ❌ /*/
    Route::get('/Ajouter.un.compte', 'add_new_admin_account_page')->name('dashboard.add_admin_account');
    Route::post('/add_new_admin_account_request', 'add_new_admin_account_request')->name('dashboard.add_admin_account_request');
    Route::post('/check_user_account', 'check_user_account')->name('dashboard.check_user_account');
    Route::get('/Modifier.un.compte/{id}', 'edit_new_admin_account')->name('dashboard.edit_admin_account');
    Route::post('/update_new_admin_account_request/{id}', 'update_admin_account_request')->name('dashboard.update_admin_account_request');
    Route::get('/delete_new_admin_account_request/{id}', 'delete_new_admin_account')->name('dashboard.delete_new_admin_account');
    Route::get('/Liste.admin', 'liste_admin_account')->name('dashboard.liste_admin_account');
/*/ ❌ Account Request ❌ /*/

/*/ ❌ Register Student Request ❌ /*/
    Route::get('/Étape.1.inscription', 'inscription_student_step_one')->name('dashboard.inscription_student_step_one');
    Route::post('/Étape.2.inscription/{id}/{niv}', 'inscription_student_step_two')->name('dashboard.inscription_student_step_two');
    Route::get('/Étape.3.inscription/{id}/{scolarite_id}/{inscrip_id}', 'inscription_student_step_three')->name('dashboard.inscription_student_step_three');
    Route::post('/Étape.4.inscription/{id}', 'inscription_student_step_last')->name('dashboard.inscription_student_step_four');

    Route::get('/Faire.une.inscription.final.etape', 'add_new_student_page_last_step')->name('dashboard.add_student_last_step');
    Route::post('/add_new_student_request', 'add_new_student_request')->name('dashboard.add_student_request');
    Route::get('/Modifier.une.inscription/{id}', 'edit_new_student')->name('dashboard.edit_student');
    Route::post('/update_new_student_request/{id}', 'update_student_request')->name('dashboard.update_student_request');
    Route::get('/delete_new_student_request/{id}', 'delete_new_student')->name('dashboard.delete_new_student');
    Route::get('/Liste.des.inscriptions', 'liste_student')->name('dashboard.liste_student');
/*/ ❌ Register Student Request ❌ /*/

/*/ ❌ Versement Scolarite Request ❌ /*/
    Route::post('/payer.scolarite/{id}', 'buy_scolarite')->name('dashboard.buy_scolarite');
    Route::get('/Repayer.paiement/{id}', 'edit_new_student')->name('dashboard.edit_inscription');
/*/ ❌ Versement Scolarite Request ❌ /*/

/*/ ❌ After Inscription Scolarite Request ❌ /*/
    Route::get('/impression.de.recu/{id}', 'print_inscription_invoice')->name('dashboard.print_inscription_invoice');
    Route::get('/voir.details/{id}', 'view_details')->name('dashboard.view_details');
/*/ ❌ After Inscription Scolarite Request ❌ /*/


/*/ ❌ Expense Journal Request ❌ /*/
    Route::get('/Ajouter.un.journal.de.dépense', 'add_new_expense_journal_page')->name('dashboard.add_expense_journal');
    Route::post('/add_new_expense_journal_request', 'add_new_expense_journal_request')->name('dashboard.add_expense_journal_request');
    Route::get('/Modifier.un.journal.de.dépense/{id}', 'edit_expense_journal')->name('dashboard.edit_expense_journal');
    Route::post('/update_new_expense_journal_request/{id}', 'update_expense_journal_request')->name('dashboard.update_expense_journal_request');
    Route::get('/delete_new_expense_journal_request/{id}', 'delete_expense_journal')->name('dashboard.delete_expense_journal');
    Route::get('/Liste.de.journal.de.dépense', 'liste_expense_journal')->name('dashboard.liste_expense_journal');
    Route::get('/Détails.de.journal.de.dépense/{slug}', 'detail_expense_journal')->name('dashboard.detail_expense_journal');
    Route::post('/search_expenses_journal/{type}', 'search_expenses_journal')->name('search_expenses_journal');
/*/ ❌ Expense Journal Request ❌ /*/


/*/ ❌ Other Expense Journal Request ❌ /*/
    Route::get('/Ajouter.un.journal.autres.entrées.en.caisses', 'add_new_other_expense_journal_page')->name('dashboard.add_other_expense_journal');
    Route::post('/add_new_other_expense_journal_request', 'add_new_other_expense_journal_request')->name('dashboard.add_other_expense_journal_request');
    Route::get('/Modifier.un.journal.autres.entrées.en.caisses/{id}', 'edit_other_expense_journal')->name('dashboard.edit_other_expense_journal');
    Route::post('/update_new_other_expense_journal_request/{id}', 'update_other_expense_journal_request')->name('dashboard.update_other_expense_journal_request');
    Route::get('/delete_new_other_expense_journal_request/{id}', 'delete_other_expense_journal')->name('dashboard.delete_other_expense_journal');
    Route::get('/Liste.de.journal.autres.entrées.en.caisses', 'liste_other_expense_journal')->name('dashboard.liste_other_expense_journal');
    Route::get('/Détails.de.journal.autres.entrées.en.caisses/{slug}', 'detail_other_expense_journal')->name('dashboard.detail_other_expense_journal');
    Route::post('/search_other_expenses_journal/{type}', 'search_other_expenses_journal')->name('search_other_expenses_journal');
/*/ ❌ Other Expense Journal Request ❌ /*/

/*/ ❌ Construction Expense Journal Request ❌ /*/
    Route::get('/Ajouter.un.journal.de.dépense.construction', 'add_new_construction_expense_journal_page')->name('dashboard.add_construction_expense_journal');
    Route::post('/add_new_construction_expense_journal_request', 'add_new_construction_expense_journal_request')->name('dashboard.add_construction_expense_journal_request');
    Route::get('/Modifier.un.journal.de.dépense.construction/{id}', 'edit_construction_expense_journal')->name('dashboard.edit_construction_expense_journal');
    Route::post('/update_new_construction_expense_journal_request/{id}', 'update_construction_expense_journal_request')->name('dashboard.update_construction_expense_journal_request');
    Route::get('/delete_new_construction_expense_journal_request/{id}', 'delete_construction_expense_journal')->name('dashboard.delete_construction_expense_journal');
    Route::get('/Liste.de.journal.de.dépense.construction', 'liste_construction_expense_journal')->name('dashboard.liste_construction_expense_journal');
    Route::get('/Détails.de.journal.de.dépense.construction/{slug}', 'detail_construction_expense_journal')->name('dashboard.detail_construction_expense_journal');
    Route::post('/search_construction_expenses_journal/{type}', 'search_construction_expenses_journal')->name('search_construction_expenses_journal');
/*/ ❌ Construction Expense Journal Request ❌ /*/

/*/ ❌ Movement Bank Request ❌ /*/
    Route::get('/Ajouter.un.mouvement.bancaire', 'add_new_movement_bank_page')->name('dashboard.add_movement_bank');
    Route::post('/add_new_movement_bank_request', 'add_new_movement_bank_request')->name('dashboard.add_movement_bank_request');
    Route::get('/Modifier.un.mouvement.bancaire/{id}', 'edit_movement_bank')->name('dashboard.edit_movement_bank');
    Route::post('/update_new_movement_bank_request/{id}', 'update_movement_bank_request')->name('dashboard.update_movement_bank_request');
    Route::get('/delete_new_movement_bank_request/{id}', 'delete_movement_bank')->name('dashboard.delete_movement_bank');
    Route::get('/Liste.de.mouvement.bancaire', 'liste_movement_bank')->name('dashboard.liste_movement_bank');
    Route::get('/Détails.de.mouvement.bancaire/{slug}', 'detail_movement_bank')->name('dashboard.detail_movement_bank');
    Route::post('/search_movement_bank/{type}', 'search_movement_bank')->name('search_movement_bank');
/*/ ❌ Movement Bank Request ❌ /*/

/*/ ❌ Register Student For Computer Science Request ❌ /*/
    Route::get('/Étape.1.inscription.informatique', 'inscription_computer_science_student_step_one')->name('dashboard.inscription_computer_science_student_step_one');
    Route::post('/Étape.2.inscription.informatique', 'inscription_computer_science_student_step_two')->name('dashboard.inscription_computer_science_student_step_two');
    Route::post('/Étape.3.inscription.informatique/{id}', 'inscription_computer_science_student_step_three')->name('dashboard.inscription_computer_science_student_step_three');
    Route::post('/Étape.4.inscription.informatique/{id}', 'inscription_computer_science_student_step_last')->name('dashboard.inscription_computer_science_student_step_four');

    Route::get('/Faire.une.inscription.final.etape', 'add_new_student_page_last_step')->name('dashboard.add_computer_science_student_last_step');
    Route::post('/add_new_student_request', 'add_new_student_request')->name('dashboard.add_computer_science_student_request');
    Route::get('/Modifier.une.inscription.informatique/{id}', 'edit_new_computer_science_student')->name('dashboard.edit_computer_science_student');
    Route::post('/update_new_student_request/{id}', 'update_computer_science_student_request')->name('dashboard.update_computer_science_student_request');
    Route::get('/delete_new_student_request/{id}', 'delete_new_computer_science_student')->name('dashboard.delete_new_computer_science_student');
    Route::get('/Liste.des.inscriptions.informatique', 'liste_computer_science_student')->name('dashboard.liste_computer_science_student');
    Route::post('/search_computer_science_student/{type}', 'search_computer_science_student')->name('search_computer_science_student');
/*/ ❌ Register Student For Computer Science Request ❌ /*/

/*/ ❌ Scolarite Computer Science Request ❌ /*/
Route::get('/Ajouter.une.scolarite.informatique', 'add_new_scolarites_computer_science_page')->name('dashboard.add_scolarites_computer_science');
Route::post('/add_new_scolarites_computer_science_request', 'add_new_scolarites_computer_science_request')->name('dashboard.add_scolarites_computer_science_request');
Route::get('/Modifier.une.scolarites.informatique/{id}', 'edit_new_scolarites_computer_science')->name('dashboard.edit_scolarites_computer_science');
Route::post('/update_new_scolarites_computer_science_request/{id}', 'update_scolarites_computer_science_request')->name('dashboard.update_scolarites_computer_science_request');
Route::get('/delete_new_scolarites_computer_science_request/{id}', 'delete_new_scolarites_computer_science')->name('dashboard.delete_new_scolarites_computer_science');
Route::get('/Liste.scolarites.informatique', 'liste_scolarites_computer_science')->name('dashboard.liste_scolarites_computer_science');
/*/ ❌ Scolarite Computer Science Request ❌ /*/

/*/ ❌ Historic Request ❌ /*/
    Route::get('/Détails.historiques/{slug}', 'detail_historic')->name('dashboard.detail_historic');
    Route::get('/Liste.des.historiques.d\'inscriptions', 'list_historic')->name('dashboard.list_historic');
/*/ ❌ Historic Request ❌ /*/

/*/ ❌ Bilan Financier Request ❌ /*/
    Route::get('/bilan.financier', 'bilan_financier_content')->name('dashboard.bilan_financier_content');
    Route::post('/contenu.bilan.financier', 'show_bilan_financier_content_by_years')->name('show_bilan_financier_content_by_years');
/*/ ❌ Bilan Financier Request ❌ /*/

/*/ ❌ Infos Caisse Jour Request ❌ /*/
    Route::get('/infos.caisse.jour', 'infos_caisse_jour_content')->name('dashboard.infos_caisse_jour');
    Route::post('/contenu.infos.caisse.jour', 'show_infos_caisse_jour_content_by_years')->name('show_infos_caisse_jour_content_by_years');
/*/ ❌ Infos Caisse Jour Request ❌ /*/

/*/ ❌ Situation Tresor Request ❌ /*/
    Route::get('/situation.tresor', 'situation_tresor_content')->name('dashboard.situation_tresor');
    Route::post('/contenu.situation.tresor', 'show_situation_tresor_content_by_years')->name('show_situation_tresor_content_by_years');
/*/ ❌ Situation Tresor Request ❌ /*/

/*/ ❌ Situation Tresor Request ❌ /*/
    Route::get('/informations.resultats/{nbre}', 'informations_resultats')->name('dashboard.informations_resultats');
    Route::get('/informations', 'informations_content')->name('dashboard.informations');
    Route::post('/contenu.informations', 'show_informations_content_by_years')->name('show_informations_content_by_years');
    Route::get('/contenu.informations.option_1/{option_1}', 'informations_content_option_1')->name('dashboard.informations.option_1');
    Route::get('/contenu.informations.option_2/{option_2}', 'informations_content_option_2')->name('dashboard.informations.option_2');
/*/ ❌ Situation Tresor Request ❌ /*/

/*/ ❌ Historic Request ❌ /*/
Route::get('/Détails.statistiques/{slug}', 'detail_statistiques')->name('dashboard.detail_statistiques');
Route::get('/Liste.des.statistiques', 'list_statistiques')->name('dashboard.list_statistiques');
/*/ ❌ Historic Request ❌ /*/

//🏀 END REQUEST ZONE //

});
