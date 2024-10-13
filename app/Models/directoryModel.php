<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class directoryModel extends Model
{
    use HasFactory;

    static function insert($data,$email,$phone){
        $checkRecord=DB::table('directory')->where(['email'=>$email,'phone'=>$phone])->first();
        if($checkRecord){
            return true;
        }
        $insert=DB::table('directory')->insert($data);
        if($insert){
            return true;
        }
        return false;
    }

    static function fetchDirectory(){
        $fetch=DB::table('directory')->get();
        if($fetch){
            return $fetch;
        }
        return false;
    }
}
