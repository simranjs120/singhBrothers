<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class labelsModel extends Model
{
    use HasFactory;

    static function fetchLabels(){
        $data=DB::table('labels')->get();
        if($data){
            return $data;
        }
        return false;
    }

    static function insertData($data){
        $action=DB::table('labels')->insert($data);
        if($action){
            return true;
        }
        return false;
    }

    static function editData($name,$id){
        $edit=DB::table('labels')->where('id',$id)->update(['name'=>$name]);
        if($edit){
            return true;
        }
        return false;
    }

    static function getLabelWithId($id){
        $data=DB::table('labels')->where('id',$id)->first();
        if($data){
            return $data;
        }
        return NULL;
    }

    static function changeLabelStatus($status,$id){
        $update=DB::table('labels')->where('id',$id)->update(['status'=>$status]);
        if($update){
            return true;
        }
        return false;
    }

    static function deleteLabel($id){
        $delete=DB::table('labels')->where('id',$id)->delete();
        if($delete){
            return true;
        }
        return false;
    }

    static function selectedForId($id){
        $data=DB::table('label_inventory')->where('label_id',$id)->get();
        if($data){
            return $data;
        }
        return false;
    }

    static function erasePreviousAssingment($id){
        $delete=DB::table('label_inventory')->where('label_id',$id)->delete();
        if($delete){
            return true;
        }
        return false;
    }

    static function newAssignment($payload,$id){
        $insert=DB::table('label_inventory')->insert(['inventory_id'=>$payload,'label_id'=>$id]);
        if($insert){
            return true;
        }
        return false; 
    }
}
