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

    static function deleteCategory($id){
        $fetchSubcategories=DB::table('sub_category')->where(['category_id'=>$id])->first();
        if($fetchSubcategories){
            return 2;
        }
        $update=DB::table('category')->where(['id'=>$id])->delete();
        if($update){
            return 1;
        }
        return 0;
    }
    
    static function subCategoryCount($id){
        $count=DB::table('sub_category')->where(['category_id'=>$id])->count();
        if($count){
            return $count;
        }
        return 0;
    }

    static function fetchSubCategories(){
        $data=DB::table('sub_category')->get();
        $newarr=array();
        foreach($data as $row){
            $newarr['id']=$row->id;
            $newarr['category_id']=DB::table('category')->where('id',$row->category_id)->first('category');
            $newarr['sub_category']=$row->sub_category;
            $newarr['status']=$row->status;
            $newarr['created_at']=$row->created_at;
            $results[]=$newarr;
        }
        if(!empty($results)){
            return $results;
        }
        return false;
    }

    static function submitSubCategories($data){
        $insert=DB::table('sub_category')->insert($data);
        if($insert){
            return true;
        }
        return false;
    }
}
