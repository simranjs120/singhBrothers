<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class queryModel extends Model
{
    use HasFactory;

    static function fetchQueries($type){
        $fetch=DB::table('queries')->where('type',$type)->get();
        if($fetch){
            return $fetch;
        }
        return false;
    }
    static function insert($data){
        $insert=DB::table('queries')->insert($data);
        if($insert){
            return true;
        }
        return false;
    }

}
