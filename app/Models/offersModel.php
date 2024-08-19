<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class offersModel extends Model
{
    use HasFactory;

    static function submitOffers($data){
        $insert=DB::table('offers')->insert($data);
        if($insert){
            return true;
        }
        return false;
    }

    static function fetchOffers(){
        $data=DB::table('offers')->get();
        return $data;
    }

    static function changeStatus($status,$id){
        $change=DB::table('offers')->where('id',$id)->update(['status'=>$status]);
        if($change){
            return true;
        }
        return false;
    }

    static function getOfferWithId($id){
        $data=DB::table('offers')->where('id',$id)->first();
        return $data;
    }

    static function editInventory($id,$data){
        $edit=DB::table('offers')->where('id',$id)->update($data);
        if($edit){
            return true;
        }
        return false;
    }

    static function deleteData($id){
        $delete=DB::table('offers')->where('id',$id)->delete();
        if($delete){
            return true;
        }
        return false;
    }

    static function getDataForAutoManage(){
        $data=DB::table('offers')->get();
        return $data;
    }

    static function autoChange($id,$status){
        $change=DB::table('offers')->where('id',$id)->update(['status'=>$status]);
        if($change){
            return true;
        }
        return false;
    }
}
