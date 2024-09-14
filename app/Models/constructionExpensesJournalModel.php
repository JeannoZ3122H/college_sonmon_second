<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class constructionExpensesJournalModel extends Model
{
    use HasFactory;

    protected $fileable = [
        'construction_date_depense',
        'construction_pc_number',
        'construction_designation',
        'construction_quantity',
        'construction_unit_price',
        'construction_montant_designation',
        'construction_cumul_montant_designation',
        'construction_observation',
        'slug'
    ];

}
