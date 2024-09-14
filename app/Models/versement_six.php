<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class versement_six extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscription_id',
        'invoice',
        'balance',
        'slug'
    ];
}
