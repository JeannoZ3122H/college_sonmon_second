<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminAccountModel extends Model
{
    use HasFactory;

    protected $fileable = [
        'role_id',
        'fname',
        'lname',
        'email',
        'school',
        'phone',
        'address',
        'city',
        'fonction',
        'matricule',
        'admin_img',
        'status_account',
        'slug'
    ];
}
