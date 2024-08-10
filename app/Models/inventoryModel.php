<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class inventoryModel extends Model
{
    use HasFactory;

    static function getInventory(){
        $data=DB::table('inventory')->get();
        return $data;
    }
    static function getCollections(){
        $data=DB::table('collections')->get();
        return $data;
    }

    static function createInventory($data){
        $create=DB::table('inventory')->insert($data);
        if($create){
            return true;
        }
        return false;
    }

    static function updateInventory($id,$data){
        $update=DB::table('inventory')->where('id',$id)->update($data);
        if($update){
            return true;
        }
        return false;
    }

    static function getcateAndSubCat($collection_id){
        $data=DB::table('collections')->where('id',$collection_id)->first();
        return $data;
    }

    static function getInventoryWithId($id){
        $data=DB::table('inventory')->where('id',$id)->first();
        return $data;
    }

    static function deleteInventory($id){
        $delete=DB::table('inventory')->where('id',$id)->delete();
        if($delete){
            return true;
        }
        return false;
    }
    static function changeInventoryStatus($status,$id){
        $update=DB::table('inventory')->where('id',$id)->update(['status'=>$status]);
        if($update){
            return true;
        }
        return false;
    }
}
