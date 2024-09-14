<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenseJournalModel extends Model
{
    use HasFactory;

    protected $fileable = [
        'date_depense',
        'pc_number',
        'designation',
        'quantity',
        'unit_price',
        'montant_designation',
        'cumul_montant_designation',
        'observation',
        'slug'
    ];
}
