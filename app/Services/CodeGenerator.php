<?php

namespace App\Services;
use RealRashid\SweetAlert\Facades\Alert;

class CodeGenerator

{

    public static function slug(){
        $lenght= 170;
        $keys = substr(str_shuffle(
            str_repeat($x = 'abcdefghijklmnopqrstuvwxyz1234567890', ceil($lenght / strlen($x)))
        ), 3, $lenght);
        return $keys;
    }

}
