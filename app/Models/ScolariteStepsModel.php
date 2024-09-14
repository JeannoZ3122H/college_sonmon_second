<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScolariteStepsModel extends Model
{
    use HasFactory;


    protected $fileable = [
        'author_id',
        'niveau_etude_id',
        'price',
        'school_year_start',
        'school_year_end',
        'slug'
    ];
}
