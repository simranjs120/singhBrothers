<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class innerSectionModel extends Model
{
    use HasFactory;

    static function fetchSections(){
        $data=DB::table('inner_section')->get();
        if($data){
            return $data;
        }
        return false;
    }

    static function addData($payload){
        $data=DB::table('inner_section')->insert($payload);
        if($data){
            return true;
        }
        return false;
    }

    static function editData($payload,$id){
        $data=DB::table('inner_section')->where('id',$id)->update($payload);
        if($data){
            return true;
        }
        return false;
    }

    static function changeStatus($status,$id){
        $data=DB::table('inner_section')->where('id',$id)->update(['status'=>$status]);
        if($data){
            return true;
        }
        return false;
    }

    static function getSectionWithId($id){
        $data=DB::table('inner_section')->where('id',$id)->first();
        if($data){
            return $data;
        }
        return false;
    }

    static function deleteData($id){
        $delete=DB::table('inner_section')->where('id',$id)->delete();
        if($delete){
            return true;
        }
        return false;
    }
    
    static function selectedForId($id){
        $data=DB::table('inventory_section')->where('section_id',$id)->get();
        if($data){
            return $data;
        }
        return false;
    }

    static function erasePreviousAssingment($id){
        $delete=DB::table('inventory_section')->where('section_id',$id)->delete();
        if($delete){
            return true;
        }
        return false;
    }
    static function newAssignment($payload,$id){
        $insert=DB::table('inventory_section')->insert(['inventory_id'=>$payload,'section_id'=>$id]);
        if($insert){
            return true;
        }
        return false; 
    }

    static function checkSpotLight(){
        $check=DB::table('inner_section')->where('type','spotlight')->first();
        if($check){
            return true;
        }
        return false;
    }
}
