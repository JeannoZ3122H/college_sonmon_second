<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    use HasFactory;

    protected $fileable = [
        'author_id',
        'school_name',
        'localite',
        'email',
        'phone_number',
        'date_creation',
        'address',
    ];

}
