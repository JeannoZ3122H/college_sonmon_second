<?php

namespace App\Http\viewComposers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HeaderComposer {

    public function Compose(View $view){
        if(Auth::user()){
            $id = Auth::user()->id;
            $view->with("_user",  DB::table('admin_accounts')
            ->join('roles', 'admin_accounts.role_id', '=', 'roles.id')
            ->select('roles.role', 'admin_accounts.*')
            ->where('admin_accounts.id', $id)
            ->first());

            $view->with("user", DB::table('users')
            ->join('admin_accounts', 'users.user_id', 'admin_accounts.id')
            ->select('admin_accounts.*','admin_accounts.id as user_id', 'users.*')
            ->where('users.id', $id)
            ->first());

            $view->with('user_data', Auth::user());
            $view->with('data', User::find(Auth::user()->id));
        }
    }
}
