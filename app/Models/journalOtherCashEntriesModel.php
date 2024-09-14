<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class journalOtherCashEntriesModel extends Model
{
    use HasFactory;

    protected $fileable = [
        'autre_date_depense',
        'autre_pc_number',
        'autre_designation',
        'autre_quantity',
        'autre_unit_price',
        'autre_montant_designation',
        'autre_cumul_montant_designation',
        'autre_observation',
        'slug'
    ];
}
