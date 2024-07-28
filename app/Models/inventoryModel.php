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

    static function getcateAndSubCat($collection_id){
        $data=DB::table('collections')->where('id',$collection_id)->first();
        return $data;
    }
}
