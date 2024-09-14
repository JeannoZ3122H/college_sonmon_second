<?php

namespace App\Services;

use App\Models\bankMovementModel;
use RealRashid\SweetAlert\Facades\Alert;

class bankMovementService
{

    public static function index()
    {
        try {
            return bankMovementModel::all();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }

    public static function store($request)
    {
        try {

            $add = new bankMovementModel();
            $add->movement_bank_date = $request->movement_bank_date;
            $add->movement_bank_libelle = $request->movement_bank_libelle;
            $add->bank = $request->movement_bank_bank;
            $add->versement_bank = $request->movement_bank_versement_bank;
            $add->alimentation_box_by_bank = $request->movement_bank_alimentation_box_by_bank;
            $add->slug = CodeGenerator::slug();

            if ($add->save()) :
                $last_register = bankMovementModel::all();

                // dd(count($last_register));
                if (count($last_register) == 1) :
                    $update = bankMovementModel::Where('id', $add->id)
                        ->update([
                            'balances' => intval($add->versement_bank)
                        ]);

                    if ($update) :
                        return ['success' => 'true'];
                    else :
                        return ['error' => 'false'];
                    endif;
                else :
                    $cumul_montant = 0;
                    foreach ($last_register as $value) {
                        $cumul_montant += intval($value->versement_bank);
                    }

                    $update = bankMovementModel::Where('id', $add->id)
                    ->update([
                        'balances' =>  $cumul_montant
                    ]);

                    if ($update) :
                        return ['success' => 'true'];
                    else :
                        return ['error' => 'false'];
                    endif;
                endif;
            else :
                return ['error' => 'Bad request detected'];
            endif;
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function edit($id)
    {
        try {
            $infos = bankMovementModel::Where('id', $id)
                ->first();
            if ($infos) :
                return ['success' => 'true', 'infos' => $infos];
            else :
                return ['error' => 'false'];
            endif;
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function update($request, $id)
    {
        try {
            $edit = bankMovementModel::Where('id', $id)->first();
            $edit->movement_bank_date = $request->movement_bank_date;
            $edit->movement_bank_libelle = $request->movement_bank_libelle;
            $edit->bank = $request->movement_bank_bank;
            $edit->versement_bank = $request->movement_bank_versement_bank;
            $edit->alimentation_box_by_bank = $request->movement_bank_alimentation_box_by_bank;

            if ($edit->save()):
                $last_register = bankMovementModel::all();
                if (count($last_register) == 1) :
                    $update = bankMovementModel::Where('id', $edit->id)
                    ->update([
                        'balances' => intval($edit->versement_bank)
                    ]);

                    if ($update) :
                        return ['success' => 'true'];
                    else :
                        return ['error' => 'false'];
                    endif;
                else :
                    $count = 0;
                    $cumul_montant = 0;
                    foreach ($last_register as $value) {
                        $cumul_montant += intval($value->versement_bank);
                        $value->balances = $cumul_montant;
                        $value->save();
                        $count++;
                    }

                    // dd($last_register);
                    if ($count == count($last_register) ) :
                        return ['success' => 'true'];
                    else :
                        return ['error' => 'false'];
                    endif;
                endif;
            else :
                return ['error' => 'Bad request detected'];
            endif;
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function destroy($id)
    {
        try {

            $delete = bankMovementModel::Where('id', $id)->delete();

            if($delete):
                $last_register = bankMovementModel::all();
                $count = 0;
                $cumul_montant = 0;
                foreach ($last_register as $value) {
                    $cumul_montant += intval($value->versement_bank);
                    $value->balances = $cumul_montant;
                    $value->save();
                    $count++;
                }

                // dd($last_register);
                if ($count == count($last_register) ) :
                    return ['success' => 'true'];
                else :
                    return ['error' => 'false'];
                endif;
            else :
                return ['error' => 'Bad request detected'];
            endif;
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function show_content($slug)
    {
        try {
            $infos = bankMovementModel::Where('slug', $slug)
                ->first();
            if ($infos) :
                return ['success' => 'true', 'infos' => $infos];
            else :
                return ['error' => 'false'];
            endif;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function check()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function single_search_movement_bank($search)
    {
        try {
            return bankMovementModel::Where('movement_bank_libelle', 'like', "%" . $search->search_single . "%")->get();
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function group_search_movement_bank($search)
    {
        try {
            // dd($search->all());
            return bankMovementModel::Where('movement_bank_date', '>=', $search->date_start)
                ->OrWhere('movement_bank_date', '=<', $search->date_fin)
                ->get();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }
}
