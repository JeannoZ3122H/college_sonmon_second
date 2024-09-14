<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriptionModel extends Model
{
    use HasFactory;


    protected $fillable = [
        'author_id',
        'classroom_id',
        'niveau_etude_id',
        'scolarite_id',
        'fname',
        'lname',
        'date_naissance',
        'lieu_naissance',
        'matricule',
        'fullname_mather',
        'fullname_father',
        'emergency_phone',
        'niveau_etude_id',
        'scolarite_year',
        'scolarite_totale',
        'reliquat',
        'reste_scolarite',
        'total_versement',
        'slug'
    ];
}
