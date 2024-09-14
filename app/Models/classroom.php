<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    use HasFactory;

    protected $fileable = [
        'author_id',
        'classroom',
        'level',
        'building',
        'slug'
    ];
}
