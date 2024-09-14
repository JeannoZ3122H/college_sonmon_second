<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['authentification']]);
    }

    public function forget_password_email_verify(Request $request)
    {
        if (empty($request->email)):
            MessageService::isEmpty('email');
            return back();
        endif;
        $users = DB::table('users')->where('email', $request->email)->first();
        if (!$users) {
            MessageService::isDataNoFound();
            return redirect()->route('login');
        } else {
            $users_status_account = DB::table('admin_accounts')
                ->where('id', $users->id)->value('status_account');
            if ($users_status_account == 1) {
                DB::table('users')->where('email', $request->email)
                    ->update(['status_connection' => 0]);
                session()->put('email', $request->email);
                MessageService::isSuccess('Votre email existe vous pouvez continuer. Merci !');
                return redirect()->route('new_password');
            } else {
                MessageService::isSuccess('Votre email existe vous pouvez continuer. Merci !');
                return redirect()->route('new_password');
            }
        }
    }

    public function forget_password_reset(Request $request)
    {
        if (empty($request->new_password)):
            MessageService::isEmpty('nouveau mot de passe');
            return back();
        endif;
        if (empty($request->confirmation)):
            MessageService::isEmpty('confirmation du nouveau mot de passe');
            return back();
        endif;
        if ($request->new_password != $request->confirmation):
            MessageService::isError('le mot de passe et la confirmation sont pas identique. Merci !');
            return back();
        endif;

        $users = DB::table('users')->where('email', session()->get('email'))->first();
        if (!$users) {
            MessageService::isDataNoFound();
            return redirect()->route('new_password');
        } else {
            $users_status_account = DB::table('admin_accounts')
                ->where('id', $users->id)->value('status_account');
            if ($users_status_account == 1) {
                $u_resp = DB::table('users')->where('email', session()->get('email'))
                    ->update(['status_connection' => 0, 'password' => Hash::make($request->new_password)]);
                if ($u_resp):
                    session()->flush();
                    MessageService::isSuccess('Modification effectuée vous pouvez continuer. Merci !');
                    return redirect()->route('login');
                else:
                    MessageService::isError('Échec de modification de mot de passe. Réessayer s\'il vous plaît !');
                    return redirect()->route('new_password');
                endif;
            } else {
                MessageService::isError('Échec de modification de mot de passe. Réessayer s\'il vous plaît !');
                return redirect()->route('new_password');
            }
        }
    }

    public function logOut($id)
    {
        if (isset($id)) {

            $get_user_status = DB::table('users')
            ->where('id', $id)
            ->value('status_connection');

            if ($get_user_status == 1) {
                $user_offline = DB::table('users')
                    ->where('id', $id)
                    ->update(['status_connection' => 0]);

                if ($user_offline == true) {
                    Session::flush();
                    Auth::logout();
                    MessageService::logoutSuccess();
                    return redirect()->route('login');
                } else {
                    MessageService::isErrorFailed();
                    return back();
                }
            } else {
                MessageService::isAlreadlyDisconnected();
                return redirect()->route('login');
            }
        } else {
            MessageService::isErrorFailed();
            return back();
        }
    }

    public function authentification(Request $request) {


        if(empty($request->email)):
            MessageService::isEmpty('email');
            return back();
        endif;

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)):
            return response()->json(
                [
                    'code' => 302,
                    'status' => 'erreur',
                    'message' => "L'adresse e-mail n'est pas valide"
                ]
            );
        endif;

        if(empty($request->password)):
            return response()->json(
                [
                    'code' => 302,
                    'status' => 'erreur',
                    'message' => "Le mot de passe est obligatoire"
                ]
            );
        endif;

        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(
                [
                    'code' => 302,
                    'status' => 'erreur',
                    'message' => "Oups! accès interdit !👺, Email ou mot de passe introuvable"
                ]
            );
        }
        $users = DB::table('users')->where('email', $request->email)->first();

        if (! $users || ! password_verify($request->password, $users->password))
        {
            return response()->json(
                [
                    'code' => 300,
                    'status' => 'erreur',
                    'message' => "Le mot de passe est incorrecte"
                ]
            );
        }

        $users_status = DB::table('users')->where('email', $request->email)
            ->value('status_connection');
        if ($users_status == 1) {
            $users_status_verify = DB::table('users')->where('email', $request->email)
                ->update(['status_connection' => 0]);
        }

        $users_status_verify = DB::table('users')->where('email', $request->email)
            ->update(['status_connection' => 1]);

        if ($users_status_verify):
            $users_id = DB::table('users')
                ->where('id', $users->id)->value('user_id');

            $users_status_account = DB::table('admin_accounts')
                ->where('id', $users_id)->value('status_account');

            if( $users_status_account == 1):

                $users_is_logged = DB::table('admin_accounts')
                ->join('users', 'admin_accounts.id', '=', 'users.user_id')
                ->join('roles', 'admin_accounts.role_id', '=', 'roles.id')
                ->select('users.email', 'users.status_connection','roles.role', 'admin_accounts.*')
                ->where('admin_accounts.id', $users->id)->first();

                if($users_is_logged):
                    DB::table('users')->where('id', $users->id)->update(['status_connection' => 1]);
                    $request->session()->regenerate();
                    return redirect()->intended(route('index'));
                endif;
            else:
                return back();
            endif;
        else:
            return back();
        endif;

    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function updateUserPassword(Request $user)
    {
        try {
            if (empty($user->email)):
                return response()->json(
                    [
                        'code' => 302,
                        'status' => 'erreur',
                        'message' => "L'adresse e-mail est obligatoire."
                    ]
                );
            endif;

            if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)):
                return response()->json(
                    [
                        'code' => 302,
                        'status' => 'erreur',
                        'message' => "L'adresse e-mail n'est pas valide"
                    ]
                );
            endif;

            if (empty($user->password)):
                return response()->json(
                    [
                        'code' => 302,
                        'status' => 'erreur',
                        'message' => "Le mot de passe est obligatoire."
                    ]
                );
            endif;

            $is_admin_accounts = DB::table('administration_models')
                ->join('users', 'administration_models.user_id', '=', 'users.id')->where('users.email', $user->email)
                ->first();



            if ($is_admin_accounts == null ) {
                return response()->json(
                    [
                        'code' => 302,
                        'status' => 'erreur',
                        'message' => "Oups ! Votre compte n'existe pas ou est introuvable"
                    ]
                );
            } elseif ($is_admin_accounts != null ) {

                $password = password_hash($user->password, PASSWORD_BCRYPT);

                $isUpdated = DB::table('users')->where('email', $user->email)->update([
                    'password' => $password
                ]);
                if ($isUpdated) {

                    $notifiction = "Votre mot de passe a été modifié avec succès." . " " . "#Adresse email: " . " " . $user->email . " " . "#Nouveau mot de passe: " . " " . $user->password;
                    // Mail::to($user->email)
                    //     ->send(new ForgetPasswordMailer($notifiction));

                    return response()->json(
                        [
                            'code' => 200,
                            'status' => 'succès',
                            'message' => "Ok ! Votre mot de passe a été modifié avec succès. Un mail vous a été envoyé sur votre adresse."
                        ]
                    );
                }
            }

        } catch (\Throwable $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'code' => 302,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

}
