<?php

namespace App\Services;

use App\Models\computerRegistrationModel;
use RealRashid\SweetAlert\Facades\Alert;

class computerRegistrationService
{
    public function index(){

    }

    public function store(){

    }

    public function update(){

    }

    public function destroy(){

    }

    public function check(){

    }

    public static function single_search_computer_science_student($search)
    {
        try {
            return computerRegistrationModel::Where('designation', 'like', "%" . $search->search_single . "%")->get();
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function group_search_computer_science_student($search)
    {
        try {
            // dd($search->all());
            return computerRegistrationModel::Where('date_depense', '>=', $search->date_start)
                ->OrWhere('date_depense', '=<', $search->date_fin)
                ->get();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }
}
