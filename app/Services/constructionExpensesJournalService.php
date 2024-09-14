<?php

namespace App\Services;

use App\Models\constructionExpensesJournalModel;
use RealRashid\SweetAlert\Facades\Alert;

class constructionExpensesJournalService
{

    public static function index()
    {
        try {
            return constructionExpensesJournalModel::all();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }

    public static function store($request)
    {
        try {

            $add = new constructionExpensesJournalModel();
            $add->construction_designation = $request->designation;
            $add->construction_quantity = $request->qty;
            $add->construction_unit_price = $request->unit_price;
            $add->construction_date_depense = $request->date_depense;
            $add->construction_pc_number = $request->pc_number;
            $add->construction_observation = $request->observation;
            $add->slug = CodeGenerator::slug();

            $add->construction_montant_designation = intval($request->unit_price) * intval($request->qty);

            if ($add->save()) :
                $last_register = constructionExpensesJournalModel::all();

                // dd(count($last_register));
                if (count($last_register) == 1) :
                    $update = constructionExpensesJournalModel::Where('id', $add->id)
                        ->update([
                            'construction_cumul_montant_designation' => intval($add->construction_montant_designation)
                        ]);

                    if ($update) :
                        return ['success' => 'true'];
                    else :
                        return ['error' => 'false'];
                    endif;
                else :
                    $cumul_montant = 0;
                    foreach ($last_register as $value) {
                        $cumul_montant += intval($value->construction_montant_designation);
                    }

                    $update = constructionExpensesJournalModel::Where('id', $add->id)
                    ->update([
                        'construction_cumul_montant_designation' =>  $cumul_montant
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
            $infos = constructionExpensesJournalModel::Where('id', $id)
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
            $edit = constructionExpensesJournalModel::Where('id', $id)->first();

            $edit->construction_designation = $request->designation;
            $edit->construction_quantity = $request->qty;
            $edit->construction_unit_price = $request->unit_price;
            $edit->construction_date_depense = $request->date_depense;
            $edit->construction_pc_number = $request->pc_number;
            $edit->construction_observation = $request->observation;
            $edit->construction_montant_designation = intval($request->unit_price) * intval($request->qty);

            if ($edit->save()):
                $last_register = constructionExpensesJournalModel::all();
                if (count($last_register) == 1) :
                    $update = constructionExpensesJournalModel::Where('id', $edit->id)
                    ->update([
                        'cumul_montant_designation' => intval($edit->construction_montant_designation)
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
                        $cumul_montant += intval($value->construction_montant_designation);
                        $value->construction_cumul_montant_designation = $cumul_montant;
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

            $delete = constructionExpensesJournalModel::Where('id', $id)->delete();

            if($delete):
                $last_register = constructionExpensesJournalModel::all();
                $count = 0;
                $cumul_montant = 0;
                foreach ($last_register as $value) {
                    $cumul_montant += intval($value->construction_montant_designation);
                    $value->construction_cumul_montant_designation = $cumul_montant;
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
            $infos = constructionExpensesJournalModel::Where('slug', $slug)
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
            return constructionExpensesJournalModel::Where('construction_designation', 'like', "%" . $search->search_single . "%")->get();
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function group_search_expenses_journal($search)
    {
        try {
            // dd($search->all());
            return constructionExpensesJournalModel::Where('construction_date_depense', '>=', $search->date_start)
                ->OrWhere('construction_date_depense', '=<', $search->date_fin)
                ->get();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }
}
