<?php

namespace App\Services;

use App\Models\journalOtherCashEntriesModel;
use RealRashid\SweetAlert\Facades\Alert;

class journalOtherCashEntriesService
{

    public static function index()
    {
        try {
            return journalOtherCashEntriesModel::all();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }

    public static function store($request)
    {
        try {

            $add = new journalOtherCashEntriesModel();
            $add->autre_designation = $request->designation;
            $add->autre_quantity = $request->qty;
            $add->autre_unit_price = $request->unit_price;
            $add->autre_date_depense = $request->date_depense;
            $add->autre_pc_number = $request->pc_number;
            $add->autre_observation = $request->observation;
            $add->slug = CodeGenerator::slug();

            $add->autre_montant_designation = intval($request->unit_price) * intval($request->qty);

            if ($add->save()) :
                $last_register = journalOtherCashEntriesModel::all();

                // dd(count($last_register));
                if (count($last_register) == 1) :
                    $update = journalOtherCashEntriesModel::Where('id', $add->id)
                        ->update([
                            'autre_cumul_montant_designation' => intval($add->autre_montant_designation)
                        ]);

                    if ($update) :
                        return ['success' => 'true'];
                    else :
                        return ['error' => 'false'];
                    endif;
                else :
                    $cumul_montant = 0;
                    foreach ($last_register as $value) {
                        $cumul_montant += intval($value->autre_montant_designation);
                    }

                    $update = journalOtherCashEntriesModel::Where('id', $add->id)
                    ->update([
                        'autre_cumul_montant_designation' =>  $cumul_montant
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
            $infos = journalOtherCashEntriesModel::Where('id', $id)
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
            $edit = journalOtherCashEntriesModel::Where('id', $id)->first();

            $edit->autre_designation = $request->designation;
            $edit->autre_quantity = $request->qty;
            $edit->autre_unit_price = $request->unit_price;
            $edit->autre_date_depense = $request->date_depense;
            $edit->autre_pc_number = $request->pc_number;
            $edit->autre_observation = $request->observation;
            $edit->autre_montant_designation = intval($request->unit_price) * intval($request->qty);

            if ($edit->save()):
                $last_register = journalOtherCashEntriesModel::all();
                if (count($last_register) == 1) :
                    $update = journalOtherCashEntriesModel::Where('id', $edit->id)
                    ->update([
                        'autre_cumul_montant_designation' => intval($edit->autre_montant_designation)
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
                        $cumul_montant += intval($value->autre_montant_designation);
                        $value->autre_cumul_montant_designation = $cumul_montant;
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

            $delete = journalOtherCashEntriesModel::Where('id', $id)->delete();

            if($delete):
                $last_register = journalOtherCashEntriesModel::all();
                $count = 0;
                $cumul_montant = 0;
                foreach ($last_register as $value) {
                    $cumul_montant += intval($value->autre_montant_designation);
                    $value->autre_cumul_montant_designation = $cumul_montant;
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
            $infos = journalOtherCashEntriesModel::Where('slug', $slug)
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

    public static function single_search_expenses_journal($search)
    {
        try {
            return journalOtherCashEntriesModel::Where('autre_designation', 'like', "%" . $search->search_single . "%")->get();
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function group_search_expenses_journal($search)
    {
        try {
            // dd($search->all());
            return journalOtherCashEntriesModel::Where('autre_date_depense', '>=', $search->date_start)
                ->OrWhere('autre_date_depense', '=<', $search->date_fin)
                ->get();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }
}
