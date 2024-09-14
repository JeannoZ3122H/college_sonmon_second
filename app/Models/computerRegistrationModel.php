<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class computerRegistrationModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'fname',
        'lname',
        'student_id',
        'matricule',
        'inscription_years',
        'scolarite_computer_science_id',
        'slug'
    ];
}
