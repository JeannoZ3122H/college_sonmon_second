<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauEtudeModel extends Model
{
    use HasFactory;


    protected $fillable = [
        'author_id',
        'niveau_etude',
        'slug'
    ];
}
