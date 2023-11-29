<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class UtilsController
{
    public static function checkExistanceCin($cin,$user1,$user2):bool{
        $cinuser1=DB::table($user1)->get('cin')->values();
        $array1=array();
        foreach ($cinuser1 as $u1){
            array_push($array1,$u1->cin);
        }
        $cinuser2=DB::table($user2)->get('cin')->values();
        $array2=array();
        foreach ($cinuser2 as $u2){
            array_push($array2,$u2->cin);
        }
        if(!in_array(intval($cin),$array1)&&!in_array(intval($cin),$array2)){
            return true;
        }
        else
            return false;

    }
}
