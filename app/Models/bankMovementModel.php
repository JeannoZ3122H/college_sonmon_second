<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankMovementModel extends Model
{
    use HasFactory;

    protected $fileable = [
        'movement_bank_date',
        'movement_bank_libelle',
        'bank',
        'versement_bank',
        'alimentation_box_by_bank',
        'balances',
        'slug'
    ];
    
}
