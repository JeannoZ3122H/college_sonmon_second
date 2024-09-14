<?php

namespace App\Services;

use App\Models\expenseJournalModel;

class expenseJournalService
{

    public static function index()
    {
        try {
            return expenseJournalModel::all();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }

    public static function store($request)
    {
        try {

            $add = new expenseJournalModel();
            $add->designation = $request->designation;
            $add->quantity = $request->qty;
            $add->unit_price = $request->unit_price;
            $add->date_depense = $request->date_depense;
            $add->pc_number = $request->pc_number;
            $add->observation = $request->observation;
            $add->slug = CodeGenerator::slug();

            $add->montant_designation = intval($request->unit_price) * intval($request->qty);

            if ($add->save()) :
                $last_register = expenseJournalModel::all();

                // dd(count($last_register));
                if (count($last_register) == 1) :
                    $update = expenseJournalModel::Where('id', $add->id)
                        ->update([
                            'cumul_montant_designation' => intval($add->montant_designation)
                        ]);

                    if ($update) :
                        return ['success' => 'true'];
                    else :
                        return ['error' => 'false'];
                    endif;
                else :
                    $cumul_montant = 0;
                    foreach ($last_register as $value) {
                        $cumul_montant += intval($value->montant_designation);
                    }

                    $update = expenseJournalModel::Where('id', $add->id)
                    ->update([
                        'cumul_montant_designation' =>  $cumul_montant
                    ]);

                    //** save by last cumul save
                    // $update = expenseJournalModel::Where('id', $add->id)
                    // ->update([
                    //     'cumul_montant_designation' => intval($last_register[count($last_register) - 2]->cumul_montant_designation) + intval($add->montant_designation)
                    // ]);

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
            $infos = expenseJournalModel::Where('id', $id)
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
            $edit = expenseJournalModel::Where('id', $id)->first();

            $edit->designation = $request->designation;
            $edit->quantity = $request->qty;
            $edit->unit_price = $request->unit_price;
            $edit->date_depense = $request->date_depense;
            $edit->pc_number = $request->pc_number;
            $edit->observation = $request->observation;
            $edit->montant_designation = intval($request->unit_price) * intval($request->qty);

            if ($edit->save()):
                $last_register = expenseJournalModel::all();
                if (count($last_register) == 1) :
                    $update = expenseJournalModel::Where('id', $edit->id)
                    ->update([
                        'cumul_montant_designation' => intval($edit->montant_designation)
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
                        $cumul_montant += intval($value->montant_designation);
                        $value->cumul_montant_designation = $cumul_montant;
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

            $delete = expenseJournalModel::Where('id', $id)->delete();

            if($delete):
                $last_register = expenseJournalModel::all();
                $count = 0;
                $cumul_montant = 0;
                foreach ($last_register as $value) {
                    $cumul_montant += intval($value->montant_designation);
                    $value->cumul_montant_designation = $cumul_montant;
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
            $infos = expenseJournalModel::Where('slug', $slug)
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
            return expenseJournalModel::Where('designation', 'like', "%" . $search->search_single . "%")->get();
        } catch (\Throwable $th) {
            return ['bad' => $th->getMessage()];
        }
    }

    public static function group_search_expenses_journal($search)
    {
        try {
            // dd($search->all());
            return expenseJournalModel::Where('date_depense', '>=', $search->date_start)
                ->OrWhere('date_depense', '=<', $search->date_fin)
                ->get();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }
}
