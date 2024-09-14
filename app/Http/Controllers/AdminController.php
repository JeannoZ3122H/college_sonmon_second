<?php

namespace App\Http\Controllers;

use App\Models\admin_account;
use App\Models\bankMovementModel;
use App\Models\classroom;
use App\Models\computerRegistrationModel;
use App\Models\constructionExpensesJournalModel;
use App\Models\expenseJournalModel;
use App\Models\inscription;
use App\Models\journalOtherCashEntriesModel;
use App\Models\niveau_etude;
use App\Models\role;
use App\Models\school;
use App\Models\scolarite_step;
use App\Models\scolarite;
use App\Models\User;
use App\Models\versement_five;
use App\Models\versement_four;
use App\Models\versement_heigh;
use App\Models\versement_nine;
use App\Models\versement_one;
use App\Models\versement_seven;
use App\Models\versement_six;
use App\Models\versement_three;
use App\Models\versement_two;
use App\Services\bankMovementService;
use App\Services\CodeGenerator;
use App\Services\computerRegistrationService;
use App\Services\constructionExpensesJournalService;
use App\Services\expenseJournalService;
use App\Services\informationService;
use App\Services\journalOtherCashEntriesService;
use App\Services\MessageService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    // Comments number
    /*
        01.FUNCTIONS BASE
        02.SCHOOLS FUNCTIONS
        03.ACCOUNTS ADMIN FUNCTIONS
        04.ROLES FUNCTIONS
        05.CLASSROOM FUNCTIONS
        06.REGISTER STUDENT FUNCTIONS
        07.NIVEAU ETUDE FUNCTIONS
        08.BUY SCOLARITE
        09.DETAILS INSCRIPTION FUNCTIONS
        10.PRINT INVOICE INSCRIPTION FUNCTIONS
        11.HISTORIQUE INSCRIPTION FUNCTIONS
    */


    public function get_months(){
        $all_list_month = [];
        for ($m=1; $m<=12; $m++) {
            $all_list_month[] = strftime("%B", strtotime(date('F', mktime(0,0,0,$m, 1, date('Y')))));
        }

        return $all_list_month;
    }

//*🟠🟠🟠🟠*// 01.FUNCTIONS BASE //*🟠🟠🟠🟠*//

    public function __construct(){
        $this->middleware("auth")->except(["auth", 'forget_password']);
    }

    public function forget_password(){
        return view('pages.auth.auth');
    }

    public function auth(){
        return view('pages.auth.auth');
    }

    public function dashboard(){
        $list_admin = DB::table('admin_accounts')
        ->join('roles', 'admin_accounts.role_id', '=', 'roles.id')
        ->select('roles.role', 'admin_accounts.*')
        ->get();
        return view('pages.dashboard', compact('list_admin'));
    }

    public function profile(){
        // dd(Auth::user()); die();
        $data = DB::table('users')
        ->join('admin_accounts', 'users.user_id', 'admin_accounts.id')
        ->select('admin_accounts.*','admin_accounts.id as user_id', 'users.*')
        ->where('users.id','=',Auth::user()->id)
        ->first();

        dd($data);
        return view('pages.profile', compact(
            'data'
        ));
    }

//*🟠🟠🟠🟠*// 01.FUNCTIONS BASE //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 02.SCHOOLS FUNCTIONS //*🟠🟠🟠🟠*//

    // page
    public function add_new_school_page(){
        return view('pages.other-pages.schools.add_school');
    }

    // get
    public function liste_school()
    {
        $liste_school = school::all();

        return view('pages.other-pages.schools.liste_school',
        compact(
            [
                'liste_school'
            ]
        ));
    }

    // add
    public function add_new_school_request(Request $request)
    {
        if(empty($request->school_name)){
            MessageService::isEmpty('nom de l\'école');
            return back();
        }

        if(empty($request->localite)){
            MessageService::isEmpty('localité');
          return back();
        }

        if(empty($request->email)){
            MessageService::isEmpty('email');
          return back();
        }

        if(empty($request->phone_number)){
            MessageService::isEmpty('fix de l\'établissement');
          return back();
        }

        if(empty($request->address)){
            MessageService::isEmpty('adresse de l\'école');
          return back();
        }

        if(empty($request->date_creation)){
            MessageService::isEmpty('date de création de l\'école');
          return back();
        }

        $add_data = new school();

        $add_data->school_name = $request->school_name;
        $add_data->localite = $request->localite;
        $add_data->email = $request->email;
        $add_data->phone_number = $request->phone_number;
        $add_data->date_creation = $request->date_creation;
        $add_data->address = $request->address;

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_school');
        }
    }

    // edit
    public function edit_new_school($id){
        $data = DB::table('schools')->where('id', $id)->first();
        return view('pages.other-pages.schools.edit_school',
        compact(['data']));
    }
    // update
    public function update_school_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->school_name)){
                MessageService::isEmpty('nom de l\'école');
                return back();
            }

            if(empty($request->localite)){
                MessageService::isEmpty('localité');
            return back();
            }

            if(empty($request->email)){
                MessageService::isEmpty('email');
            return back();
            }

            if(empty($request->phone_number)){
                MessageService::isEmpty('fix de l\'établissement');
            return back();
            }

            if(empty($request->address)){
                MessageService::isEmpty('adresse de l\'école');
            return back();
            }

            if(empty($request->date_creation)){
                MessageService::isEmpty('date de création de l\'école');
            return back();
            }

            $update_data = school::Where('id', $id)->first();
            $update_data->school_name = $request->school_name;
            $update_data->localite = $request->localite;
            $update_data->email = $request->email;
            $update_data->phone_number = $request->phone_number;
            $update_data->date_creation = $request->date_creation;
            $update_data->address = $request->address;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_school');
            }
        }
    }
    // delete
    public function delete_new_school($id){
        $data = DB::table('schools')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.other-pages.schools.liste_school');
        }
    }

//*🟠🟠🟠🟠*// 02.END SCHOOLS FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 03. ADMIN ACCOUNT FUNCTIONS //*🟠🟠🟠🟠*//
    // pages
    public function add_new_admin_account_page(){
        $liste_school = school::all();
        $liste_role = role::all();
        return view('pages.accounts.account_add', compact(['liste_school', 'liste_role']));
    }

    // get
    public function liste_admin_account()
    {
        $liste_admin = admin_account::join('roles', 'admin_accounts.role_id', 'roles.id')
        ->select('roles.role', 'admin_accounts.*')
        ->get();

        return view('pages.accounts.account_liste',
        compact(
            [
                'liste_admin'
            ]
        ));
    }

    // add
    public function add_new_admin_account_request(Request $request)
    {
    // dd($request->all()); die();
        if(empty($request->role_id)){
            MessageService::isEmpty('rôle');
            return back();
        }

        if(empty($request->fname)){
            MessageService::isEmpty('nom');
        return back();
        }

        if(empty($request->lname)){
            MessageService::isEmpty('prénoms');
        return back();
        }

        if(empty($request->email)){
            MessageService::isEmpty('email');
        return back();
        }

        if(empty($request->school)){
            MessageService::isEmpty('école');
        return back();
        }

        if(empty($request->phone)){
            MessageService::isEmpty('numéro de téléphone');
        return back();
        }

        if(empty($request->address)){
            MessageService::isEmpty('adresse');
        return back();
        }

        if(empty($request->city)){
            MessageService::isEmpty('la ville');
        return back();
        }

        if(empty($request->fonction)){
            MessageService::isEmpty('fonction');
        return back();
        }

        if(empty($request->matricule)){
            MessageService::isEmpty('matricule');
        return back();
        }

        if(empty($request->admin_img)){
            MessageService::isEmpty('photo');
        return back();
        }

        $add_data = new admin_account();

        if($request->hasFile('admin_img')):
            $file = $request->file('admin_img');
            $extension =  $file->getClientOriginalExtension();
            $filename ="admin_img".time().'.'.$extension;

            if($filename):
                $img = Image::make($file->getRealPath());
                $img->resize(600, 600);
                $img->save('documents/admin-img/'.$filename);
            else:
                MessageService::isErrorFailed();
                return back();
            endif;

            $path = "documents/admin-img/";
            $add_data->admin_img = URL::to('').'/'.$path.$filename;
        endif;

        if($request->accountActivation == "on"):
            $add_data->status_account = 1;
        endif;

        $add_data->role_id = $request->role_id;
        $add_data->fname = $request->fname;
        $add_data->lname = $request->lname;
        $add_data->email = $request->email;
        $add_data->school = $request->school;
        $add_data->phone = $request->phone;
        $add_data->address = $request->address;
        $add_data->city = $request->city;
        $add_data->fonction = $request->fonction;
        $add_data->matricule = $request->matricule;
        $add_data->slug = CodeGenerator::slug();


        $get_users_auth = DB::table("users")
        ->where("email", $request->email)->first();

        if($get_users_auth != null){
            MessageService::emailExist();
            return back();

        }else{
            // dd($add_data); die();
            if($add_data->save()){

                $add_to_user = new User();
                $add_to_user->full_name = $request->fname.' '.$request->lname;
                $add_to_user->email = $request->email;
                $add_to_user->user_id = DB::table('admin_accounts')->where('email', $request->email)->value('id');
                $add_to_user->role = DB::table('roles')->where('id', $request->role_id)->value('role');
                $add_to_user->user_img = $add_data->admin_img;
                $add_to_user->password = Hash::make($request->password);

                // dd($add_to_user); die();

                if($add_to_user->save()){
                    MessageService::successFully();
                    return redirect()->route('dashboard.add_admin_account');
                }
            }else{
                MessageService::isErrorFailed();
                return back();
            }
        }
    }

    // edit
    public function edit_new_admin_account($id){
        $liste_school = school::all();
        $liste_role = role::all();
        $data = DB::table('admin_accounts')
        ->join('roles', 'admin_accounts.role_id', 'roles.id')
        ->select('roles.role', 'admin_accounts.*')
        ->where('admin_accounts.id', $id)->first();
        return view('pages.accounts.account_edit',
        compact(['data', 'liste_school', 'liste_role']));
    }
     // update
    public function update_admin_account_request(Request $request, $id)
    {
        if(!empty($id)){

            // dd($request->all()); die();
            if(empty($request->role_id)){
                MessageService::isEmpty('rôle');
                return back();
            }

            if(empty($request->fname)){
                MessageService::isEmpty('nom');
              return back();
            }

            if(empty($request->lname)){
                MessageService::isEmpty('prénoms');
              return back();
            }

            if(empty($request->email)){
                MessageService::isEmpty('email');
              return back();
            }

            if(empty($request->school)){
                MessageService::isEmpty('école');
              return back();
            }

            if(empty($request->phone)){
                MessageService::isEmpty('numéro de téléphone');
              return back();
            }

            if(empty($request->address)){
                MessageService::isEmpty('adresse');
              return back();
            }

            if(empty($request->city)){
                MessageService::isEmpty('la ville');
              return back();
            }

            if(empty($request->fonction)){
                MessageService::isEmpty('fonction');
              return back();
            }

            if(empty($request->matricule)){
                MessageService::isEmpty('matricule');
              return back();
            }

            $update_data = admin_account::Where('id', $id)->first();

            if($request->hasFile('admin_img')):
                $file = $request->file('admin_img');
                $extension =  $file->getClientOriginalExtension();
                $filename ="admin_img".time().'.'.$extension;

                if($filename):
                    $img = Image::make($file->getRealPath());
                    $img->resize(600, 600);
                    $img->save('documents/admin-img/'.$filename);
                else:
                    MessageService::isErrorFailed();
                    return back();
                endif;

                $path = "documents/admin-img/";
                $update_data->admin_img = URL::to('').'/'.$path.$filename;
                dd('admin_img');
            endif;

            $update_data->role_id = $request->role_id;
            $update_data->fname = $request->fname;
            $update_data->lname = $request->lname;
            $update_data->email = $request->email;
            $update_data->school = $request->school;
            $update_data->phone = $request->phone;
            $update_data->address = $request->address;
            $update_data->city = $request->city;
            $update_data->fonction = $request->fonction;
            $update_data->matricule = $request->matricule;

            if($update_data->save()){

                // dd($add_data); die();
                $update_to_user = User::where('user_id', $id)->first();
                $update_to_user->full_name = $request->fname.' '.$request->lname;
                $update_to_user->email = $request->email;
                $update_to_user->role = DB::table('roles')->where('id', $request->role_id)->value('role');
                $update_to_user->user_img = $update_data->admin_img;
                if($update_to_user->save()){
                    MessageService::successFully();
                    return redirect()->route('dashboard.liste_admin_account');
                }else{
                    MessageService::isErrorFailed();
                    return back();
                }
            }else{
                MessageService::isErrorFailed();
                return back();
            }
        }
    }
    // delete
    public function delete_new_admin_account($id){
        $data = DB::table('users')->where('id', $id)->delete();
        $users = User::where('user_id', $id)->delete();

        if(($data == true) && ($users == true)){

            $liste_admin = admin_account::join('roles', 'users.role_id', 'roles.id')
            ->select('roles.role', 'users.*')
            ->get();

            MessageService::successFully();
            return back();
        }
    }
    // check_user_account
    public function check_user_account(Request $request){
        // dd($request->all()); die();

        if(empty($request->password)){
            MessageService::isEmpty('mot de passe');
          return back();
        }

        if(empty($request->email)){
            MessageService::isEmpty('email');
          return back();
        }

        // dump($request->id);
        $users = User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);

        // dd($users); die();
        if(($users == true) || ($users == 1)){

            $update_data = User::where('id', $request->id)
            ->update(['status' => 1]);

            if(($update_data == true) || ($update_data == 1)){
                $liste_admin = admin_account::join('roles', 'users.role_id', 'roles.id')
                ->select('roles.role', 'users.*')
                ->get();

                MessageService::successFully();
                return view('pages.accounts.account_liste',
                compact(
                    [
                        'liste_admin'
                    ]
                ));
            }else{
                MessageService::isErrorFailedUser();
                return back();
            }
        }else{
            MessageService::isErrorFailedUser();
            return back();
        }
    }
//*🟠🟠🟠🟠*// 03. ADMIN ACCOUNT FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 04.ROLES FUNCTIONS //*🟠🟠🟠🟠*//
    // page
    public function add_new_role_page(){
        return view('pages.other-pages.roles.add_role');
    }
    // get
    public function liste_role()
    {
        $liste_role = role::all();

        return view('pages.other-pages.roles.liste_role',
        compact(
            [
                'liste_role'
            ]
        ));
    }
    // add
    public function add_new_role_request(Request $request)
    {
        if(empty($request->role)){
            MessageService::isEmpty('rôle');
            return back();
        }

        $add_data = new role();

        $add_data->role = $request->role;
        $add_data->slug = $request->slug;

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_role');
        }
    }

    // edit
    public function edit_new_role($id){
        $data = DB::table('roles')->where('id', $id)->first();
        return view('pages.other-pages.roles.edit_role',
        compact(['data']));
    }
    // update
    public function update_role_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->role)){
                MessageService::isEmpty('rôle');
                return back();
            }

            $update_data = role::Where('id', $id)->first();
            $update_data->role = $request->role;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_role');
            }
        }
    }
    // delete
    public function delete_new_role($id){
        $data = DB::table('roles')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.other-pages.roles.liste_role');
        }
    }
//*🟠🟠🟠🟠*// 04.END ROLES FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 05.CLASSROOM FUNCTIONS //*🟠🟠🟠🟠*//
    // page
    public function add_new_classroom_page(){

        $liste_classe = niveau_etude::all();

        $liste_level = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            '',
            'A1-1',
            'A1-2',
            'A2-1',
            'A2-2',
            '',
            'C-1',
            'C-2',
            'D-1',
            'D-2',
        ];

        return view('pages.classrooms.add_classroom',
        compact(['liste_classe', 'liste_level']));
    }
    // get
    public function liste_classroom()
    {
        $liste_classroom = classroom::all();

        return view('pages.classrooms.liste_classroom',
        compact(
            [
                'liste_classroom'
            ]
        ));
    }
    // add
    public function add_new_classroom_request(Request $request)
    {
        if(empty($request->classroom)){
            MessageService::isEmpty('classe');
            return back();
        }
        if(empty($request->level)){
            MessageService::isEmpty('rôle');
            return back();
        }

        $add_data = new classroom();

        $add_data->classroom = $request->classroom;
        // $add_data->author_id = $request->classroom;
        $add_data->author_id = 1;
        $add_data->level = $request->level;
        $add_data->building = $request->building;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_classroom');
        }
    }
    // edit
    public function edit_new_classroom($id){

        $liste_classe = niveau_etude::all();

        $liste_level = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            '',
            'A1-1',
            'A1-2',
            'A2-1',
            'A2-2',
            '',
            'C-1',
            'C-2',
            'D-1',
            'D-2',
        ];
        $data = DB::table('classrooms')->where('id', $id)->first();
        return view('pages.classrooms.edit_classroom',
        compact(['data', 'liste_classe', 'liste_level']));
    }
    // update
    public function update_classroom_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->classroom)){
                MessageService::isEmpty('classe');
                return back();
            }
            if(empty($request->level)){
                MessageService::isEmpty('rôle');
                return back();
            }

            $update_data = classroom::Where('id', $id)->first();
            $update_data->classroom = $request->classroom;
            $update_data->level = $request->level;
            $update_data->building = $request->building;
            $update_data->slug = $request->slug;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_classroom');
            }
        }
    }
    // delete
    public function delete_new_classroom($id){
        $data = DB::table('classrooms')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.classrooms.liste_classroom');
        }
    }
//*🟠🟠🟠🟠*// 05.END CLASSROOM FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 05.SCOLARITE FUNCTIONS //*🟠🟠🟠🟠*//
    // page
    public function add_new_scolarite_page(){
        // $liste_classroom = DB::table('classrooms')->get();
        $liste_niveau_etude = niveau_etude::all();
        return view('pages.scolarites.add_scolarite',
        compact(['liste_niveau_etude']));
    }
    // get
    public function liste_scolarite()
    {
        $author = 1;
        $liste_scolarite = scolarite::join('niveau_etudes', 'scolarites.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->where('scolarites.author_id', $author)
        ->get();
        return view('pages.scolarites.liste_scolarite',
        compact(
            [
                'liste_scolarite'
            ]
        ));
    }
    // add
    public function add_new_scolarite_request(Request $request)
    {
        if(empty($request->niveau_etude_id)){
            MessageService::isEmpty('classe');
            return back();
        }
        if(empty($request->price)){
            MessageService::isEmpty('prix');
            return back();
        }
        if(empty($request->school_year_start)){
            MessageService::isEmpty('année de début');
            return back();
        }

        if(empty($request->school_year_end)){
            MessageService::isEmpty('année de fin');
            return back();
        }

        $add_data = new scolarite();

        $author = 1;
        $add_data->author_id = $author;
        $add_data->niveau_etude_id = $request->niveau_etude_id;
        $add_data->price = $request->price;
        $add_data->school_year_start = $request->school_year_start;
        $add_data->school_year_end = $request->school_year_end;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_scolarite');
        }
    }
    // edit
    public function edit_new_scolarite($id){
        $liste_niveau_etude = DB::table('niveau_etudes')->get();
        $data = DB::table('scolarites')
        ->join('niveau_etudes', 'scolarites.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->where('scolarites.id', $id)->first();
        return view('pages.scolarites.edit_scolarite',
        compact(['data', 'liste_niveau_etude']));
    }
    // update
    public function update_scolarite_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->niveau_etude_id)){
                MessageService::isEmpty('classe');
                return back();
            }
            if(empty($request->price)){
                MessageService::isEmpty('prix');
                return back();
            }
            if(empty($request->school_year_start)){
                MessageService::isEmpty('année de début');
                return back();
            }
            if(empty($request->school_year_end)){
                MessageService::isEmpty('année de fin');
                return back();
            }

            $update_data = scolarite::Where('id', $id)->first();
            $update_data->niveau_etude_id = $request->niveau_etude_id;
            $update_data->price = $request->price;
            $update_data->school_year_start = $request->school_year_start;
            $update_data->school_year_end = $request->school_year_end;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_scolarite');
            }
        }
    }
    // delete
    public function delete_new_scolarite($id){
        $data = DB::table('scolarites')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return redirect()->route('dashboard.liste_scolarite');
        }
    }
//*🟠🟠🟠🟠*// 05.END SCOLARITE FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 06. REGISTER STUDENT FUNCTIONS //*🟠🟠🟠🟠*//
    // Step 1
    public function inscription_student_step_one(){
        $liste_scolarite = scolarite::join('niveau_etudes', 'scolarites.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->groupBy('scolarites.id', 'niveau_etude_id')
        ->get();

        return view('pages.fonctionalites.students_register.std_register_step_1',
        compact(['liste_scolarite']));
    }
    // Step 2
    public function inscription_student_step_two($id, $niveau_etude){

        $liste_classroom = classroom::Where('classroom', $niveau_etude)
        ->get();

        $data = scolarite::join('niveau_etudes', 'scolarites.niveau_etude_id', '=', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->where('scolarites.id', $id)
        ->first();

        // dd($data);
        if(count($liste_classroom) > 0):
            $add_data = new inscription();
            $add_data->author_id = Auth::user()->id;
            $add_data->scolarite_total = $data->price;
            $add_data->scolarite_reste = 0;
            $add_data->niveau_etude_id = $data->niveau_etude_id;
            $add_data->scolarite_id = $data->id;
            $add_data->scolarite_years = $data->school_year_start.'-'.$data->school_year_end;
            $add_data->slug = CodeGenerator::slug();

            if($add_data->save()):
                MessageService::successFully();
                $id = $add_data->id;

                return view('pages.fonctionalites.students_register.std_register_step_2',
                compact(['data', 'liste_classroom', 'id']));
            endif;
        else:

            MessageService::failedRequest('Aucune classe trouvée pour le niveau d\'étude choisir.');
            return back();
        endif;

    }
    // Step 3
    public function inscription_student_step_three($classroom_id, $scolarite_id, $inscrip_id){

        $data_classroom = classroom::where('id', $classroom_id)->first();

        $data_scolarite = scolarite::join('niveau_etudes', 'scolarites.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->where('scolarites.id', $scolarite_id)
        ->first();

        $update_data = inscription::where('id', $inscrip_id)
        ->update([
            'classroom' => $data_classroom->classroom.' '.$data_classroom->level
        ]);

        if($update_data == true):
            $id = $inscrip_id;
            MessageService::successFully();
            return view('pages.fonctionalites.students_register.std_register_step_3',
            compact(['data_scolarite', 'id']));
        endif;
    }
    // last step
    public function inscription_student_step_last(Request $request, $id){

        if(empty($request->fname)){
            MessageService::isEmpty('nom');
        return back();
        }

        if(empty($request->lname)){
            MessageService::isEmpty('prénoms');
        return back();
        }

        if(empty($request->date_naissance)){
            MessageService::isEmpty('date de naissance');
        return back();
        }

        if(empty($request->fullname_father)){
            MessageService::isEmpty('nom complet du père');
        return back();
        }

        if(empty($request->fullname_mather)){
            MessageService::isEmpty('nom complet de la mère');
        return back();
        }

        if(empty($request->emergency_phone)){
            MessageService::isEmpty('numéro d\'urgence');
        return back();
        }

        if(empty($request->lieu_naissance)){
            MessageService::isEmpty('lieu de naissance');
        return back();
        }

        if(empty($request->matricule)){
            MessageService::isEmpty('matricule');
        return back();
        }


        $add_data = inscription::Where('id', $id)->first();
        $add_data->fname = $request->fname;
        $add_data->lname = $request->lname;
        $add_data->lieu_naissance = $request->lieu_naissance;
        $add_data->fullname_mather = $request->fullname_mather;
        $add_data->emergency_phone = $request->emergency_phone;
        $add_data->fullname_father = $request->fullname_father;
        $add_data->date_naissance = $request->date_naissance;
        $add_data->matricule = $request->matricule;

        if($add_data->save()){

            $get_data = DB::table('inscriptions')
            ->where('matricule', $request->matricule)
            ->first();
            $get_data_scolarite = DB::table('inscriptions')->where('matricule', $request->matricule)->first();

            Session::put('_data', $get_data);
            Session::put('_data_scolarite', $get_data_scolarite);

            // dump($get_data);
            // dd($get_data_scolarite); die();
            MessageService::successFully();
            return view('pages.fonctionalites.students_register.std_register_step_last', compact('get_data'));
        }

    }
    // get
    public function liste_student()
    {
        $liste_inscription = inscription::where('inscriptions.author_id', Auth::user()->id)
        ->join('niveau_etudes', 'inscriptions.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'inscriptions.*')
        ->get();

        return view('pages.inscription.liste_inscriptions',
        compact(
            [
                'liste_inscription'
            ]
        ));
    }
    // edit
    public function edit_new_student($id){
        $inscription_data = inscription::where('id', $id)->first();

        $_data = inscription::join('scolarites', 'inscriptions.scolarite_id', 'scolarites.id')
        ->join('niveau_etudes', 'inscriptions.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.*', 'niveau_etudes.id as id_niveau_etude' ,'scolarites.*', 'scolarites.id as id_scolarites', 'inscriptions.*')
        ->where('inscriptions.id', $inscription_data->id)
        ->where('inscriptions.author_id', Auth::user()->id)
        ->first();

        // dd($_data); die();

        return view('pages.inscription.edit_inscription',
        compact(['_data']));

    }
    // update
    public function update_student_request(Request $request, $id)
    {
        if(!empty($id)){

            // dd($request->all()); die();
            if(empty($request->role_id)){
                MessageService::isEmpty('rôle');
                return back();
            }

            if(empty($request->fname)){
                MessageService::isEmpty('nom');
              return back();
            }

            if(empty($request->lname)){
                MessageService::isEmpty('prénoms');
              return back();
            }

            if(empty($request->email)){
                MessageService::isEmpty('email');
              return back();
            }

            if(empty($request->school)){
                MessageService::isEmpty('école');
              return back();
            }

            if(empty($request->phone)){
                MessageService::isEmpty('numéro de téléphone');
              return back();
            }

            if(empty($request->address)){
                MessageService::isEmpty('adresse');
              return back();
            }

            if(empty($request->city)){
                MessageService::isEmpty('la ville');
              return back();
            }

            if(empty($request->fonction)){
                MessageService::isEmpty('fonction');
              return back();
            }

            if(empty($request->matricule)){
                MessageService::isEmpty('matricule');
              return back();
            }


            $update_data = admin_account::where('id', $id)->first();

            if(!empty($request->admin_img)){
                $update_data = admin_account::Where('id', $id)->first();
                if($request->hasFile('admin_img')):
                    $file = $request->file('admin_img');
                    $extension =  $file->getClientOriginalExtension();
                    $filename ="admin_img".time().'.'.$extension;

                    if($filename):
                        $img = Image::make($file->getRealPath());
                        $img->resize(600, 600);
                        $img->save('documents/admin-img/'.$filename);
                    else:
                        MessageService::isErrorFailed();
                        return back();
                    endif;

                    $path = "documents/admin-img/";
                    $update_data->admin_img = URL::to('').'/'.$path.$filename;
                endif;
            }

            $update_data->role_id = $request->role_id;
            $update_data->fname = $request->fname;
            $update_data->lname = $request->lname;
            $update_data->email = $request->email;
            $update_data->school = $request->school;
            $update_data->phone = $request->phone;
            $update_data->address = $request->address;
            $update_data->city = $request->city;
            $update_data->fonction = $request->fonction;
            $update_data->matricule = $request->matricule;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_admin_account');
            }
        }
    }
    // delete
    public function delete_new_student($id){
        $data = DB::table('users')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.accounts.account_liste');
        }
    }
//*🟠🟠🟠🟠*// 06. REGISTER STUDENT FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 07. NIVEAU ETUDE FUNCTIONS //*🟠🟠🟠🟠*//
    // pages
    public function add_new_niveau_etude_page(){
        return view('pages.other-pages.niveau_etude.add_niveau_etude');
    }
    // get
    public function liste_niveau_etude()
    {
        $liste_niveau_etude = niveau_etude::all();

        return view('pages.other-pages.niveau_etude.liste_niveau_etude',
        compact(
            [
                'liste_niveau_etude'
            ]
        ));
    }
    // add
    public function add_new_niveau_etude_request(Request $request)
    {
        if(empty($request->niveau_etude)){
            MessageService::isEmpty('niveau d\'étude');
            return back();
        }

        //  dd($request->all()); die();
        $add_data = new niveau_etude();
        $add_data->niveau_etude = $request->niveau_etude;
        $add_data->author_id = 1;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_niveau_etude');
        }
    }
    // edit
    public function edit_new_niveau_etude($id){
        $data = DB::table('niveau_etudes')
        ->where('id', $id)->first();
        return view('pages.other-pages.niveau_etude.edit_niveau_etude',
        compact(['data']));
    }
    // update
    public function update_niveau_etude_request(Request $request, $id)
    {
        if(!empty($id)){

            // dd($request->all()); die();
            if(empty($request->niveau_etude)){
                MessageService::isEmpty('niveau d\'étude');
                return back();
            }

            $update_data = niveau_etude::where('id', $id)->first();

            $update_data->niveau_etude = $request->niveau_etude;
            $update_data->author_id = 1;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_niveau_etude');
            }
        }
    }
    // delete
    public function delete_new_niveau_etude($id){
        $data = DB::table('niveau_etudes')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.other-pages.niveau_etude.liste_niveau_etude');
        }
    }
//*🟠🟠🟠🟠*// 07. NIVEAU ETUDE FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 08. BUY SCOLARITE FUNCTIONS //*🟠🟠🟠🟠*//
    public function buy_scolarite(Request $request, $id){

        if(empty($request->value)){
            MessageService::isEmpty('Montant à versé');
            return back();
        }

        $versmnt_one = versement_one::where('id', $id)->exists();
        $versmnt_two = versement_two::where('id', $id)->exists();
        $versmnt_three = versement_three::where('id', $id)->exists();
        $versmnt_four = versement_four::where('id', $id)->exists();
        $versmnt_five = versement_five::where('id', $id)->exists();
        $versmnt_six = versement_six::where('id', $id)->exists();
        $versmnt_seven = versement_seven::where('id', $id)->exists();
        $versmnt_eight = versement_heigh::where('id', $id)->exists();
        $versmnt_nine = versement_nine::where('id', $id)->exists();

        $get_data = inscription::where('id', $id)->first();

        if($get_data->scolarite_total >= $request->value):

            if($versmnt_one == false):

                $reste = $get_data->scolarite_total - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $reste
                ]);

                if($update_data == true):

                    $add_data = new versement_one();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;

            endif;

            if($versmnt_two == false && $versmnt_one == true):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_two();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;

            endif;

            if($versmnt_two == true && $versmnt_three == false):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_three();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;
            endif;

            if($versmnt_three == true && $versmnt_four == false):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_four();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;
            endif;

            if($versmnt_four == true && $versmnt_five == false):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_five();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;
            endif;

            if($versmnt_five == true && $versmnt_six == false):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_six();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;
            endif;

            if($versmnt_six == true && $versmnt_seven == false):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_seven();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;
            endif;

            if($versmnt_seven == true && $versmnt_eight == false):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_heigh();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;
            endif;

            if($versmnt_eight == true && $versmnt_nine == false):

                $new_reste = $get_data->scolarite_reste - $request->value;

                $update_data = inscription::where('id', $id)
                ->update([
                    'scolarite_reste' => $new_reste
                ]);

                if($update_data == true):

                    $add_data = new versement_nine();

                    $add_data->author_id = Auth::user()->id;
                    $add_data->inscription_id = $request->id;
                    $add_data->balance = $request->value;
                    $add_data->slug = CodeGenerator::slug();

                    if($add_data->save()){
                        Session::remove('_data');
                        MessageService::successFully();
                        return redirect()->route('dashboard.liste_student');
                    }
                else
                    return  MessageService::isErrorFailed();
                endif;
            endif;
        else:
            MessageService::failedRequest('le montant saisir est supérieure à la scolarité totale de la classe');
            return back();
        endif;

    }
//*🟠🟠🟠🟠*// 08. BUY SCOLARITE FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 09. DETAILS INSCRIPTION FUNCTIONS //*🟠🟠🟠🟠*//
    public function view_details($id){

        $_data = inscription::join('scolarites', 'inscriptions.scolarite_id', 'scolarites.id')
        ->join('niveau_etudes', 'inscriptions.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.*', 'niveau_etudes.id as id_niveau_etude' ,'scolarites.*', 'scolarites.id as id_scolarites', 'inscriptions.*')
        ->where('inscriptions.id', $id)
        ->where('inscriptions.author_id', Auth::user()->id)
        ->first();

        return view('pages.inscription.details_inscription',
        compact(['_data']));
    }
    // landscape
//*🟠🟠🟠🟠*// 09. DETAILS INSCRIPTION FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 10. PRINT INVOICE INSCRIPTION FUNCTIONS //*🟠🟠🟠🟠*//
    public function print_inscription_invoice($id){

        $data = inscription::join('scolarites', 'inscriptions.scolarite_id', 'scolarites.id')
        ->join('niveau_etudes', 'inscriptions.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.*', 'niveau_etudes.id as id_niveau_etude' ,'scolarites.*', 'scolarites.id as id_scolarites', 'inscriptions.*')
        ->where('inscriptions.id', $id)
        ->where('inscriptions.author_id', Auth::user()->id)
        ->first();


        $filename ="recu_inscription".time();
        $path = "documents/recu_inscription/".$filename.".pdf";

        $pdf = Pdf::loadView('pages.inscription.print_inscription', compact(
        'data',
        ))
        ->setPaper('a4', 'portrait')
        ->save(public_path($path));

        return $pdf->stream('recu_inscription.pdf');
    }
    // landscape
//*🟠🟠🟠🟠*// 10. PRINT INVOICE INSCRIPTION FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 11. HISTORIQUE INSCRIPTION FUNCTIONS //*🟠🟠🟠🟠*//
    // list
    public function list_historic(){
        $list_historics = niveau_etude::all();
        return view('pages.other-pages.historics.liste_historic',
        compact(
            [
                'list_historics'
            ]
        ));
    }
    // list
    public function detail_historic(){

    }
//*🟠🟠🟠🟠*// 11. HISTORIQUE INSCRIPTION FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 12. EXPENSES JOURNAL FUNCTIONS //*🟠🟠🟠🟠*//
    // list
    public function liste_expense_journal(){
        $response = expenseJournalService::index();
        if(isset($response['error'])):
            dd($response);
        else:
            $list = $response;
            return view('pages.fonctionalites.expense_journal.list_expense_journal',
            compact(['list']));
        endif;
    }
    // search expenses journal
    public function search_expenses_journal(Request $request, $type){
        if($type == 'single'):
            if(empty($request->search_single)){
                MessageService::isEmpty('désignation');
                return back();
            }
            $response = expenseJournalService::single_search_expenses_journal($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.expense_journal.list_expense_journal',
                compact(['list']));
            endif;
        endif;

        if($type == 'group'):
            if(empty($request->date_start)){
                MessageService::isEmpty('Date de début');
                return back();
            }
            if(empty($request->date_fin)){
                MessageService::isEmpty('Date de fin');
                return back();
            }
            $response = expenseJournalService::group_search_expenses_journal($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.expense_journal.list_expense_journal',
                compact(['list']));
            endif;
        endif;
    }
    // add pages
    public function add_new_expense_journal_page(){
        return view('pages.fonctionalites.expense_journal.add_expense_journal');
    }
    // add request
    public function add_new_expense_journal_request(Request $request){
        if(empty($request->designation)){
            MessageService::isEmpty('désignation');
            return back();
        }
        if(empty($request->date_depense)){
            MessageService::isEmpty('date de la dépense');
            return back();
        }
        if(empty($request->qty)){
            MessageService::isEmpty('quantité');
            return back();
        }
        if(empty($request->unit_price)){
            MessageService::isEmpty('prix unitaire');
            return back();
        }
        if(empty($request->pc_number)){
            MessageService::isEmpty('PC N°');
            return back();
        }
        $response = expenseJournalService::store($request);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.add_expense_journal');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // details expenses journal
    public function detail_expense_journal($slug){
        if(!isset($slug)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = expenseJournalService::show_content($slug);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        // dd($response['infos']);
        if(isset($response['success'])):
            $infos = $response['infos'];
            return view('pages.fonctionalites.expense_journal.details_expense_journal',
            compact(
                [
                    'infos'
                ]
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // edit
    public function edit_expense_journal($id){
        if(!isset($id)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = expenseJournalService::edit($id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $data = $response['infos'];
            return view('pages.fonctionalites.expense_journal.edit_expense_journal',
            compact(
                [
                    'data'
                ]
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // update
    public function update_expense_journal_request(Request $request, $id){
        if(empty($request->designation)){
            MessageService::isEmpty('désignation');
            return back();
        }
        if(empty($request->date_depense)){
            MessageService::isEmpty('date de la dépense');
            return back();
        }
        if(empty($request->qty)){
            MessageService::isEmpty('quantité');
            return back();
        }
        if(empty($request->unit_price)){
            MessageService::isEmpty('prix unitaire');
            return back();
        }
        if(empty($request->pc_number)){
            MessageService::isEmpty('PC N°');
            return back();
        }
        $response = expenseJournalService::update($request, $id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.liste_expense_journal');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // destroy
    public function delete_expense_journal($id){
        if(!isset($id)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = expenseJournalService::destroy($id);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $list = expenseJournalModel::all();
            return view('pages.fonctionalites.expense_journal.list_expense_journal',
            compact(['list']));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
//*🟠🟠🟠🟠*// 12. EXPENSES JOURNAL FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 13. OTHER EXPENSES JOURNAL FUNCTIONS //*🟠🟠🟠🟠*//
    // list
    public function liste_other_expense_journal(){
        $response = journalOtherCashEntriesService::index();
        if(isset($response['error'])):
            dd($response);
        else:
            $list = $response;
            return view('pages.fonctionalites.other_expense_journal.list_other_expense_journal',
            compact(['list']));
        endif;
    }
    // search expenses journal
    public function search_other_expenses_journal(Request $request, $type){
        if($type == 'single'):
            if(empty($request->search_single)){
                MessageService::isEmpty('désignation');
                return back();
            }
            $response = journalOtherCashEntriesService::single_search_expenses_journal($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.other_expense_journal.list_other_expense_journal',
                compact(['list']));
            endif;
        endif;

        if($type == 'group'):
            if(empty($request->date_start)){
                MessageService::isEmpty('Date de début');
                return back();
            }
            if(empty($request->date_fin)){
                MessageService::isEmpty('Date de fin');
                return back();
            }
            $response = journalOtherCashEntriesService::group_search_expenses_journal($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.other_expense_journal.list_other_expense_journal',
                compact(['list']));
            endif;
        endif;
    }
    // add pages
    public function add_new_other_expense_journal_page(){
        return view('pages.fonctionalites.other_expense_journal.add_other_expense_journal');
    }
    // add request
    public function add_new_other_expense_journal_request(Request $request){
        if(empty($request->designation)){
            MessageService::isEmpty('désignation');
            return back();
        }
        if(empty($request->date_depense)){
            MessageService::isEmpty('date de la dépense');
            return back();
        }
        if(empty($request->qty)){
            MessageService::isEmpty('quantité');
            return back();
        }
        if(empty($request->unit_price)){
            MessageService::isEmpty('prix unitaire');
            return back();
        }
        if(empty($request->pc_number)){
            MessageService::isEmpty('PC N°');
            return back();
        }
        $response = journalOtherCashEntriesService::store($request);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.add_other_expense_journal');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // details expenses journal
    public function detail_other_expense_journal($slug){
        if(!isset($slug)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = journalOtherCashEntriesService::show_content($slug);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        // dd($response['infos']);
        if(isset($response['success'])):
            $infos = $response['infos'];
            return view('pages.fonctionalites.other_expense_journal.details_other_expense_journal',
            compact(
                [
                    'infos'
                ]
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // edit
    public function edit_other_expense_journal($id){
        if(!isset($id)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = journalOtherCashEntriesService::edit($id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $data = $response['infos'];
            return view('pages.fonctionalites.other_expense_journal.edit_other_expense_journal',
            compact(
                ['data']
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // update
    public function update_other_expense_journal_request(Request $request, $id){
        if(empty($request->designation)){
            MessageService::isEmpty('désignation');
            return back();
        }
        if(empty($request->date_depense)){
            MessageService::isEmpty('date de la dépense');
            return back();
        }
        if(empty($request->qty)){
            MessageService::isEmpty('quantité');
            return back();
        }
        if(empty($request->unit_price)){
            MessageService::isEmpty('prix unitaire');
            return back();
        }
        if(empty($request->pc_number)){
            MessageService::isEmpty('PC N°');
            return back();
        }
        $response = journalOtherCashEntriesService::update($request, $id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.liste_other_expense_journal');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // destroy
    public function delete_other_expense_journal($id){
        if(!isset($id)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = journalOtherCashEntriesService::destroy($id);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $list = journalOtherCashEntriesModel::all();
            return view('pages.fonctionalites.other_expense_journal.list_other_expense_journal',
            compact(['list']));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
//*🟠🟠🟠🟠*// 13. OTHER EXPENSES JOURNAL FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 14. CONSTRCUTION EXPENSES JOURNAL FUNCTIONS //*🟠🟠🟠🟠*//
    // list
    public function liste_construction_expense_journal(){
        $response = constructionExpensesJournalService::index();
        if(isset($response['error'])):
            dd($response);
        else:
            $list = $response;
            return view('pages.fonctionalites.construction_expense_journal.list_construction_expense_journal',
            compact(['list']));
        endif;
    }
    // search expenses journal
    public function search_construction_expenses_journal(Request $request, $type){
        if($type == 'single'):
            if(empty($request->search_single)){
                MessageService::isEmpty('désignation');
                return back();
            }
            $response = constructionExpensesJournalService::single_search_expenses_journal($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.construction_expense_journal.list_construction_expense_journal',
                compact(['list']));
            endif;
        endif;

        if($type == 'group'):
            if(empty($request->date_start)){
                MessageService::isEmpty('Date de début');
                return back();
            }
            if(empty($request->date_fin)){
                MessageService::isEmpty('Date de fin');
                return back();
            }
            $response = constructionExpensesJournalService::group_search_expenses_journal($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.construction_expense_journal.list_construction_expense_journal',
                compact(['list']));
            endif;
        endif;
    }
    // add pages
    public function add_new_construction_expense_journal_page(){
        return view('pages.fonctionalites.construction_expense_journal.add_construction_expense_journal');
    }
    // add request
    public function add_new_construction_expense_journal_request(Request $request){
        if(empty($request->designation)){
            MessageService::isEmpty('désignation');
            return back();
        }
        if(empty($request->date_depense)){
            MessageService::isEmpty('date de la dépense');
            return back();
        }
        if(empty($request->qty)){
            MessageService::isEmpty('quantité');
            return back();
        }
        if(empty($request->unit_price)){
            MessageService::isEmpty('prix unitaire');
            return back();
        }
        if(empty($request->pc_number)){
            MessageService::isEmpty('PC N°');
            return back();
        }
        $response = constructionExpensesJournalService::store($request);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.add_construction_expense_journal');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // details expenses journal
    public function detail_construction_expense_journal($slug){
        if(!isset($slug)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = constructionExpensesJournalService::show_content($slug);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        // dd($response['infos']);
        if(isset($response['success'])):
            $infos = $response['infos'];
            return view('pages.fonctionalites.construction_expense_journal.details_construction_expense_journal',
            compact(
                [
                    'infos'
                ]
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // edit
    public function edit_construction_expense_journal($id){
        if(!isset($id)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = constructionExpensesJournalService::edit($id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $data = $response['infos'];
            return view('pages.fonctionalites.construction_expense_journal.edit_construction_expense_journal',
            compact(
                ['data']
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // update
    public function update_construction_expense_journal_request(Request $request, $id){
        if(empty($request->designation)){
            MessageService::isEmpty('désignation');
            return back();
        }
        if(empty($request->date_depense)){
            MessageService::isEmpty('date de la dépense');
            return back();
        }
        if(empty($request->qty)){
            MessageService::isEmpty('quantité');
            return back();
        }
        if(empty($request->unit_price)){
            MessageService::isEmpty('prix unitaire');
            return back();
        }
        if(empty($request->pc_number)){
            MessageService::isEmpty('PC N°');
            return back();
        }
        $response = constructionExpensesJournalService::update($request, $id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.liste_construction_expense_journal');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // destroy
    public function delete_construction_expense_journal($id){
        if(!isset($id)){
            MessageService::isError('Aucun journal de dépense trouvé');
            return back();
        }
        $response = constructionExpensesJournalService::destroy($id);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $list = constructionExpensesJournalModel::all();
            return view('pages.fonctionalites.construction_expense_journal.list_construction_expense_journal',
            compact(['list']));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
//*🟠🟠🟠🟠*// 14. CONSTRCUTION EXPENSES JOURNAL FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 15. MOVMENT BANK FUNCTIONS //*🟠🟠🟠🟠*//
    // list
    public function liste_movement_bank(){
        $response = bankMovementService::index();
        if(isset($response['error'])):
            dd($response);
        else:
            $list = $response;
            return view('pages.fonctionalites.movement_bank.list_movement_bank',
            compact(['list']));
        endif;
    }
    // search expenses journal
    public function search_movement_bank(Request $request, $type){
        if($type == 'single'):
            if(empty($request->search_single)){
                MessageService::isEmpty('libellé');
                return back();
            }
            $response = bankMovementService::single_search_movement_bank($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.movement_bank.list_movement_bank',
                compact(['list']));
            endif;
        endif;

        if($type == 'group'):
            if(empty($request->date_start)){
                MessageService::isEmpty('Date de début');
                return back();
            }
            if(empty($request->date_fin)){
                MessageService::isEmpty('Date de fin');
                return back();
            }
            $response = bankMovementService::group_search_movement_bank($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $list = $response;
                return view('pages.fonctionalites.movement_bank.list_movement_bank',
                compact(['list']));
            endif;
        endif;
    }
    // add pages
    public function add_new_movement_bank_page(){
        return view('pages.fonctionalites.movement_bank.add_movement_bank');
    }
    // add request
    public function add_new_movement_bank_request(Request $request){
        if(empty($request->movement_bank_date)){
            MessageService::isEmpty('date');
            return back();
        }
        if(empty($request->movement_bank_libelle)){
            MessageService::isEmpty('libellé');
            return back();
        }
        if(empty($request->movement_bank_bank)){
            MessageService::isEmpty('banque');
            return back();
        }
        if(empty($request->movement_bank_versement_bank)){
            MessageService::isEmpty('versement en banque');
            return back();
        }

        // dd($request->all());

        $response = bankMovementService::store($request);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.add_movement_bank');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // details expenses journal
    public function detail_movement_bank($slug){
        if(!isset($slug)){
            MessageService::isError('Aucun mouvement bancaire trouvé');
            return back();
        }
        $response = bankMovementService::show_content($slug);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        // dd($response['infos']);
        if(isset($response['success'])):
            $infos = $response['infos'];
            return view('pages.fonctionalites.movement_bank.details_movement_bank',
            compact(
                [
                    'infos'
                ]
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // edit
    public function edit_movement_bank($id){
        if(!isset($id)){
            MessageService::isError('Aucun mouvement bancaire trouvé');
            return back();
        }
        $response = bankMovementService::edit($id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $data = $response['infos'];
            return view('pages.fonctionalites.movement_bank.edit_movement_bank',
            compact(
                ['data']
            ));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // update
    public function update_movement_bank_request(Request $request, $id){
        if(empty($request->movement_bank_date)){
            MessageService::isEmpty('date');
            return back();
        }
        if(empty($request->movement_bank_libelle)){
            MessageService::isEmpty('libellé');
            return back();
        }
        if(empty($request->movement_bank_bank)){
            MessageService::isEmpty('banque');
            return back();
        }
        if(empty($request->movement_bank_versement_bank)){
            MessageService::isEmpty('versement en banque');
            return back();
        }
        $response = bankMovementService::update($request, $id);
        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            MessageService::successFully();
            return redirect()->route('dashboard.liste_movement_bank');
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
    // destroy
    public function delete_movement_bank($id){
        if(!isset($id)){
            MessageService::isError('Aucun mouvement bancaire trouvé');
            return back();
        }
        $response = bankMovementService::destroy($id);

        if(isset($response['error'])):
            MessageService::isErrorFailed();
            return back();
        endif;

        if(isset($response['success'])):
            $list = bankMovementModel::all();
            return view('pages.fonctionalites.movement_bank.list_movement_bank',
            compact(['list']));
        endif;

        if(isset($response['bad'])):
            dd($response);
        endif;
    }
//*🟠🟠🟠🟠*// 15. MOVMENT BANK FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 16. REGISTER COMPUTER SCIENCE STUDENT FUNCTIONS //*🟠🟠🟠🟠*//
    // search expenses journal
    public function search_computer_science_student(Request $request, $type){
        if($type == 'single'):
            if(empty($request->search_single)){
                MessageService::isEmpty('élève');
                return back();
            }
            $response = computerRegistrationService::single_search_computer_science_student($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $liste_inscription_computer_science = $response;
                return view('pages.fonctionalites.register_computer_science.list_register_computer_science',
                compact(['liste_inscription_computer_science']));
            endif;
        endif;

        if($type == 'group'):
            if(empty($request->date_start)){
                MessageService::isEmpty('Date de début');
                return back();
            }
            if(empty($request->date_fin)){
                MessageService::isEmpty('Date de fin');
                return back();
            }
            $response = computerRegistrationService::group_search_computer_science_student($request);
            if(isset($response['error'])):
                dd($response);
            else:
                $liste_inscription_computer_science = $response;
                return view('pages.fonctionalites.register_computer_science.list_register_computer_science',
                compact(['liste_inscription_computer_science']));
            endif;
        endif;
    }
    // Step 1
    public function inscription_computer_science_student_step_one(){
        return view('pages.fonctionalites.register_computer_science.add.add_register_computer_science');
    }
    // Step 2
    public function inscription_computer_science_student_step_two(Request $request){

        if(empty($request->matricule)){
            MessageService::isErrorFailed('matricule de l\'élève');
            return back();
        }

        $data = inscription::join('niveau_etudes', 'inscriptions.niveau_etude_id', '=', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude' , 'inscriptions.*')
        ->where('inscriptions.matricule', $request->matricule)
        ->first();

        $liste_scolarites_computer_science = scolarite_step::where('niveau_etude_id', $data->niveau_etude_id)
        ->get();

        // dd($liste_scolarites_computer_science);

        if($data):
            MessageService::successFully();
            return view('pages.fonctionalites.register_computer_science.add.add_register_computer_science_step_two',
            compact(['data', 'liste_scolarites_computer_science']));
        else:
            MessageService::failedRequest('Aucun élève trouvé pour le matricule entrer.');
            return back();
        endif;
    }
    // Step 3
    public function inscription_computer_science_student_step_three(Request $request, $student_id){

        // dd($request->all(), $student_id);
        $add_data = new computerRegistrationModel();
        $add_data->author_id = Auth::user()->id;
        $add_data->student_id = $student_id;
        $add_data->fname = $request->fname;
        $add_data->lname = $request->lname;
        $add_data->matricule = $request->matricule;
        $add_data->scolarite_computer_science_id = $request->id_price;
        $add_data->inscription_years = $request->school_year_start.'-'.$request->school_year_end;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()):
            MessageService::successFully();
            $id = $add_data->id;
            $data = computerRegistrationModel::Where('id', $id)->first();
            return view('pages.fonctionalites.register_computer_science.list_register_computer_science',
            compact(['data', 'id']));
        endif;
    }
    // last step
    public function inscription_computer_science_student_step_last(Request $request, $id){

        if(empty($request->fname)){
            MessageService::isEmpty('nom');
        return back();
        }

        if(empty($request->lname)){
            MessageService::isEmpty('prénoms');
        return back();
        }

        if(empty($request->date_naissance)){
            MessageService::isEmpty('date de naissance');
        return back();
        }

        if(empty($request->fullname_father)){
            MessageService::isEmpty('nom complet du père');
        return back();
        }

        if(empty($request->fullname_mather)){
            MessageService::isEmpty('nom complet de la mère');
        return back();
        }

        if(empty($request->emergency_phone)){
            MessageService::isEmpty('numéro d\'urgence');
        return back();
        }

        if(empty($request->lieu_naissance)){
            MessageService::isEmpty('lieu de naissance');
        return back();
        }

        if(empty($request->matricule)){
            MessageService::isEmpty('matricule');
        return back();
        }


        $add_data = inscription::Where('id', $id)->first();
        $add_data->fname = $request->fname;
        $add_data->lname = $request->lname;
        $add_data->lieu_naissance = $request->lieu_naissance;
        $add_data->fullname_mather = $request->fullname_mather;
        $add_data->emergency_phone = $request->emergency_phone;
        $add_data->fullname_father = $request->fullname_father;
        $add_data->date_naissance = $request->date_naissance;
        $add_data->matricule = $request->matricule;

        if($add_data->save()){

            $get_data = DB::table('inscriptions')
            ->where('matricule', $request->matricule)
            ->first();
            $get_data_scolarite = DB::table('inscriptions')->where('matricule', $request->matricule)->first();

            Session::put('_data', $get_data);
            Session::put('_data_scolarite', $get_data_scolarite);

            // dump($get_data);
            // dd($get_data_scolarite); die();
            MessageService::successFully();
            return view('pages.fonctionalites.students_register.std_register_step_last', compact('get_data'));
        }

    }
    // get
    public function liste_computer_science_student()
    {
        $liste_inscription_computer_science = computerRegistrationModel::where('computer_registration_models.author_id', Auth::user()->id)
        ->join('scolarite_steps', 'computer_registration_models.scolarite_computer_science_id', 'scolarite_steps.id')
        ->join('inscriptions', 'computer_registration_models.student_id', 'inscriptions.id')
        ->select('inscriptions.*', 'scolarite_steps.price as scolarite_steps_price', 'computer_registration_models.*')
        ->get();

        // dd($liste_inscription_computer_science);

        return view('pages.fonctionalites.register_computer_science.list_register_computer_science',
        compact(['liste_inscription_computer_science']));
    }
    // edit
    public function edit_new_computer_science_student($id){
        $inscription_data = inscription::where('id', $id)->first();

        $_data = inscription::join('scolarites', 'inscriptions.scolarite_id', 'scolarites.id')
        ->join('niveau_etudes', 'inscriptions.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.*', 'niveau_etudes.id as id_niveau_etude' ,'scolarites.*', 'scolarites.id as id_scolarites', 'inscriptions.*')
        ->where('inscriptions.id', $inscription_data->id)
        ->where('inscriptions.author_id', Auth::user()->id)
        ->first();

        // dd($_data); die();

        return view('pages.inscription.edit_inscription',
        compact(['_data']));

    }
    // update
    public function update_computer_science_student_request(Request $request, $id)
    {
        if(!empty($id)){

            // dd($request->all()); die();
            if(empty($request->role_id)){
                MessageService::isEmpty('rôle');
                return back();
            }

            if(empty($request->fname)){
                MessageService::isEmpty('nom');
              return back();
            }

            if(empty($request->lname)){
                MessageService::isEmpty('prénoms');
              return back();
            }

            if(empty($request->email)){
                MessageService::isEmpty('email');
              return back();
            }

            if(empty($request->school)){
                MessageService::isEmpty('école');
              return back();
            }

            if(empty($request->phone)){
                MessageService::isEmpty('numéro de téléphone');
              return back();
            }

            if(empty($request->address)){
                MessageService::isEmpty('adresse');
              return back();
            }

            if(empty($request->city)){
                MessageService::isEmpty('la ville');
              return back();
            }

            if(empty($request->fonction)){
                MessageService::isEmpty('fonction');
              return back();
            }

            if(empty($request->matricule)){
                MessageService::isEmpty('matricule');
              return back();
            }


            $update_data = admin_account::where('id', $id)->first();

            if(!empty($request->admin_img)){
                $update_data = admin_account::Where('id', $id)->first();
                if($request->hasFile('admin_img')):
                    $file = $request->file('admin_img');
                    $extension =  $file->getClientOriginalExtension();
                    $filename ="admin_img".time().'.'.$extension;

                    if($filename):
                        $img = Image::make($file->getRealPath());
                        $img->resize(600, 600);
                        $img->save('documents/admin-img/'.$filename);
                    else:
                        MessageService::isErrorFailed();
                        return back();
                    endif;

                    $path = "documents/admin-img/";
                    $update_data->admin_img = URL::to('').'/'.$path.$filename;
                endif;
            }

            $update_data->role_id = $request->role_id;
            $update_data->fname = $request->fname;
            $update_data->lname = $request->lname;
            $update_data->email = $request->email;
            $update_data->school = $request->school;
            $update_data->phone = $request->phone;
            $update_data->address = $request->address;
            $update_data->city = $request->city;
            $update_data->fonction = $request->fonction;
            $update_data->matricule = $request->matricule;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_admin_account');
            }
        }
    }
    // delete
    public function delete_new_computer_science_student($id){
        $data = DB::table('users')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.accounts.account_liste');
        }
    }
//*🟠🟠🟠🟠*// 16. REGISTER COMPUTER SCIENCE STUDENT FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 17.SCOLARITE COMPUTER SCIENCE FUNCTIONS //*🟠🟠🟠🟠*//
    // page
    public function add_new_scolarites_computer_science_page(){
        $liste_niveau_etude = niveau_etude::all();
        return view('pages.scolarites_computer_science.add_scolarites_computer_science',
        compact(['liste_niveau_etude']));
    }
    // get
    public function liste_scolarites_computer_science()
    {
        $author = 1;
        $liste_scolarites_computer_science = scolarite_step::join('niveau_etudes', 'scolarite_steps.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarite_steps.*')
        ->where('scolarite_steps.author_id', $author)
        ->get();
        return view('pages.scolarites_computer_science.liste_scolarites_computer_science',
        compact(
            [
                'liste_scolarites_computer_science'
            ]
        ));
    }
    // add
    public function add_new_scolarites_computer_science_request(Request $request)
    {
        if(empty($request->niveau_etude_id)){
            MessageService::isEmpty('classe');
            return back();
        }
        if(empty($request->price)){
            MessageService::isEmpty('prix');
            return back();
        }
        if(empty($request->school_year_start)){
            MessageService::isEmpty('année de début');
            return back();
        }

        if(empty($request->school_year_end)){
            MessageService::isEmpty('année de fin');
            return back();
        }

        $add_data = new scolarite_step();

        $author = 1;
        $add_data->author_id = $author;
        $add_data->niveau_etude_id = $request->niveau_etude_id;
        $add_data->price = $request->price;
        $add_data->school_year_start = $request->school_year_start;
        $add_data->school_year_end = $request->school_year_end;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_scolarites_computer_science');
        }
    }
    // edit
    public function edit_new_scolarites_computer_science($id){
        $liste_niveau_etude = DB::table('niveau_etudes')->get();
        $data = DB::table('scolarite_steps')
        ->join('niveau_etudes', 'scolarite_steps.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarite_steps.*')
        ->where('scolarite_steps.id', $id)->first();
        return view('pages.scolarites_computer_science.edit_scolarites_computer_science',
        compact(['data', 'liste_niveau_etude']));
    }
    // update
    public function update_scolarites_computer_science_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->niveau_etude_id)){
                MessageService::isEmpty('classe');
                return back();
            }
            if(empty($request->price)){
                MessageService::isEmpty('prix');
                return back();
            }
            if(empty($request->school_year_start)){
                MessageService::isEmpty('année de début');
                return back();
            }
            if(empty($request->school_year_end)){
                MessageService::isEmpty('année de fin');
                return back();
            }

            $update_data = scolarite::Where('id', $id)->first();
            $update_data->niveau_etude_id = $request->niveau_etude_id;
            $update_data->price = $request->price;
            $update_data->school_year_start = $request->school_year_start;
            $update_data->school_year_end = $request->school_year_end;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_scolarites_computer_science');
            }
        }
    }
    // delete
    public function delete_new_scolarites_computer_science($id){
        $data = DB::table('scolarite_steps')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return redirect()->route('dashboard.liste_scolarites_computer_science');
        }
    }
//*🟠🟠🟠🟠*// 17.END SCOLARITE COMPUTER SCIENCE FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 18.START BILAN FINANCIER FUNCTIONS //*🟠🟠🟠🟠*//
    public $new_list = [];
    // show bilan finacier content
    public function bilan_financier_content()
    {
        return view('pages.fonctionalites.bilan_finacier.bilan_finacier');
    }
    // show bilan finacier content
    public function show_bilan_financier_content_by_years(Request $request)
    {
        // $new_list = ;
        $list_enter_scolarite = [];
        $scolarite = date('Y', strtotime($request->date_start)).'-'.date('Y', strtotime($request->date_fin));
        session()->put('scolarite', $scolarite);
        return view('pages.fonctionalites.bilan_finacier.bilan_finacier', compact(
            [
                'list_enter_scolarite'
            ]
        ));
    }
//*🟠🟠🟠🟠*// 18.END BILAN FINANCIER FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 19.START INFOS CAISSE JOUR FUNCTIONS //*🟠🟠🟠🟠*//
    public $new_infos_caisse_jour_list = [];
    // show content
    public function infos_caisse_jour_content()
    {
        return view('pages.fonctionalites.infos_caisse_jour.infos_caisse_jour');
    }
    // show content
    public function show_infos_caisse_jour_content_by_years(Request $request)
    {
        // $new_list = ;
        $list_enter_scolarite = [];
        $scolarite = date('Y', strtotime($request->date_start)).'-'.date('Y', strtotime($request->date_fin));
        session()->put('scolarite', $scolarite);
        return view('pages.fonctionalites.infos_caisse_jour.infos_caisse_jour', compact(
            [
                'list_enter_scolarite'
            ]
        ));
    }
//*🟠🟠🟠🟠*// 19.END INFOS CAISSE JOUR FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 20.START BILAN FINANCIER FUNCTIONS //*🟠🟠🟠🟠*//
    public $new_situation_tresor_list = [];
    // show content
    public function situation_tresor_content()
    {
        return view('pages.fonctionalites.situation_tresor.situation_tresor');
    }
    // show content
    public function show_situation_tresor_content_by_years(Request $request)
    {
        $list_month = [];
        for ($m=1; $m<=12; $m++) {
            $list_month[] = strftime("%B", strtotime(date('F', mktime(0,0,0,$m, 1, date('Y')))));
        }
        // $new_list = ;
        $list_enter_scolarite = [];
        return view('pages.fonctionalites.situation_tresor.situation_tresor', compact(
            [
                'list_enter_scolarite',
                'list_month',
            ]
        ));
    }
//*🟠🟠🟠🟠*// 20.END BILAN FINANCIER FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 20.START BILAN FINANCIER FUNCTIONS //*🟠🟠🟠🟠*//
    public $new_informations_list = [];
    // init
    public function informations_content()
    {
        return view('pages.fonctionalites.informations.informations');
    }
    // option 0
    public function show_informations_content_by_years(Request $request)
    {
        $list_month = $this->get_months();
        $scolarite = date('Y', strtotime($request->date_start)).'-'.date('Y', strtotime($request->date_fin));
        session()->put('scolarite', $scolarite);
        // $new_list = ;
        $list_enter_scolarite = [];
        return view('pages.fonctionalites.informations.informations', compact(
            [
                'list_enter_scolarite',
                'list_month',
            ]
        ));
    }
    // option 1
    public function informations_content_option_1($option_1)
    {
        if($option_1 == 'hebdo'){
            $option_1 = 'hebdomadaire';
        }
        $list_month = $this->get_months();
        session()->put('option_1', $option_1);
        return view('pages.fonctionalites.informations.informations_option_1', compact('option_1', 'list_month'));
    }
    // option 2
    public function informations_content_option_2($option_2)
    {
        $get_month = '';
        session()->put('option_2', $option_2);
        $list_month = $this->get_months();
        foreach ($list_month as $key => $month) {
            if($key+1 == $option_2){
                $get_month = $month;
            }
        }
        $get_month_week_number = Carbon::now()->month(session()->get('option_2'))->daysInMonth;
        $nbreWeek = 0;
        for ($i=1; $i <= $get_month_week_number; $i++) {
            if($i % 7 == 0){
                $nbreWeek++;
            }
        }
        return view('pages.fonctionalites.informations.informations_option_2', compact(['option_2', 'get_month', 'nbreWeek']));
    }
    // show content
    public function informations_resultats($value)
    {
        $list_libelle = [
            'Date',
            'Scolarite',
            'Informatique',
            'Alimentation banque',
            'Autres entrées',
            'Total entrée',
            'Dépenses',
            'Construction',
            'Dépôt banque',
        ];
        $day_open = 0;
        $period_for_tag = '';
        $get_month = '';
        $get_timestemps = '';
        $option_2 = session()->get('option_2');
        $list_month = $this->get_months();
        foreach ($list_month as $key => $month) {
            if($key+1 == $option_2){
                $get_month = $month;
            }
        }

        $get_month_week_number = Carbon::now()->month(session()->get('option_2'))->endOfMonth()->toDateString();
        $lastDay = intval(date('d', strtotime($get_month_week_number)));
        $firstDate = Carbon::now()->month(session()->get('option_2'))->startOfMonth()->toDateString();
        $lastDate = Carbon::now()->month(session()->get('option_2'))->endOfMonth()->toDateString();

        if($value == 'all'){
            $get_timestemps = 'Toutes les semaines';
            $all_date_for_month = informationService::get_hebdo_informations_by_weeks($value, $lastDay, $firstDate, $lastDate);
            $period_for_tag = informationService::get_period_for_tag($all_date_for_month);
            foreach ($all_date_for_month as $key => $da) {
                $day_open+=count($da);
            }
        }else{
            $value = intval($value);
            $all_date_for_month = informationService::get_hebdo_informations_by_weeks($value, $lastDay, $firstDate, $lastDate);
            $period_for_tag = informationService::get_period_for_tag($all_date_for_month);
        }
        return view('pages.fonctionalites.informations.informations_contenu', compact(
            [
                'get_month',
                'list_month',
                'value',
                'all_date_for_month',
                'list_libelle',
                'period_for_tag',
                'day_open',
            ]));
    }
//*🟠🟠🟠🟠*// 20.END BILAN FINANCIER FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 21. STATISTIQUES FUNCTIONS //*🟠🟠🟠🟠*//
    // list
    public function list_statistiques(){
        $list_statistique = niveau_etude::all();
        return view('pages.other-pages.statistique.liste_statistique',
        compact(
            [
                'list_statistique'
            ]
        ));
    }
    // list
    public function detail_statistiques(){

    }
//*🟠🟠🟠🟠*// 21. STATISTIQUES FUNCTIONS //*🟠🟠🟠🟠*//

//* Niveau d'etude et refaire la logique de scolarite et classe *//
}
