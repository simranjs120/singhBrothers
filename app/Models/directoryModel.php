<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class directoryModel extends Model
{
    use HasFactory;

    static function insert($data,$email,$phone){
        # Check if record already exists, If yes, Return from here or else proceed to insert.
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

    static function insertDataFromAdmin($data,$email,$phone){
        # Check if record already exists, If yes, Return from here or else proceed to insert.
        $checkRecord=DB::table('directory')->where(['email'=>$email,'phone'=>$phone])->first();
        if($checkRecord){
            return 2;
        }
        $insert=DB::table('directory')->insert($data);
        if($insert){
            return 1;
        }
        return false;
    }

    static function getItemWithId($id){
        $checkRecord=DB::table('directory')->where('id',$id)->first();
        return $checkRecord;
    }

    static function deleteItem($id){
        $deleteItem=DB::table('directory')->where('id',$id)->delete();
        if($deleteItem){
            return true;
        }
        return false;
    }

    static function updateEntry($id,$data){
        $editItem=DB::table('directory')->where('id',$id)->update($data);
        if($editItem){
            return true;
        }
        return false;        
    }
}
