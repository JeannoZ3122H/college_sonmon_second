<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Models\admin_account;
use App\Models\school;
use App\Models\role;
use App\Services\CodeGenerator;
use App\Services\MessageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['login']]);
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
}
