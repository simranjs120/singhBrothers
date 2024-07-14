<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class categoryModel extends Model
{
    use HasFactory;
    static function insertCategory($category){
        $getCheck=DB::table("category")->where(['category'=>$category])->first();
        if($getCheck){
            return 2;
        } 
            $insert=DB::table("category")->insert(['category'=>$category]);
            if($insert){
                return 1;
            } else {
                return 0;
            }
        
    }

    static function fetchCategories(){
        $data=DB::table('category')->get();
        return $data;
    }

    static function changeStatus($id,$status){
        $update=DB::table('category')->where(['id'=>$id])->update(['status'=>$status]);
        if($update){
            return true;
        }
        return false;
    }
}
