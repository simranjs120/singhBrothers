<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
class categoryModel extends Model
{
    use HasFactory;
    static function insertCategory($category,$parent_id){
        $getCheck=DB::table("category")->where(['category'=>$category])->first();
        if($getCheck){
            return 2;
        } 
            $insert=DB::table("category")->insert(['category'=>$category,'parent_id'=>$parent_id,'created_at'=>Helper::timeStamp()]);
            if($insert){
                return 1;
            } else {
                return 0;
            }
        
    }

    static function fetchCategories(){
        $data=DB::table('category')->where('parent_id',0)->get();
        return $data;
    }

    static function collectionData($id){
        $data=DB::table('collections')->where('top_parent_id',$id)->get();
        return $data;
    }

    static function fetchAllCategoryData(){
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


    static function getCategoryName($id){
        $name=DB::table('category')->where(['id'=>$id])->first('category');
        return $name;
    }

    static function getSubcategoryById($id){
        $name=DB::table('category')->where(['id'=>$id])->first('category');
        return $name;
    }

    static function deleteCategory($id){
        $fetchSubcategories=DB::table('category')->where(['parent_id'=>$id])->first();
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
        $data=DB::table('category')->where('parent_id','!=',0)->get();
        $newarr=array();
        foreach($data as $row){
            $newarr['id']=$row->id;
            $newarr['parent']=DB::table('category')->where('id',$row->parent_id)->first('category');
            $newarr['sub_category']=$row->category;
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
        $insert=DB::table('category')->insert($data);
        if($insert){
            return true;
        }
        return false;
    }

    static function fetchSubCategoryData($id){
        $data=DB::table('category')->where('parent_id','!=',0)->get();
        if($data){
            return $data;
        }
        return false;
    }

    static function checkIfTopParent($id){
        $check=DB::table('category')->where('id',$id)->first();
        if($check->parent_id==0){
            return "top";
        }
        return $check->id;
    }
    static function getLastInsertedCategoryId(){
        $data=DB::table('category')->orderBy('id', 'DESC')->first();
        return $data;
    }
    static function createNewCollectionTopParent($parent_id,$breadcrumb, $sub_category_id){
        $insert=DB::table('collections')->insert([
            'collection'=>$breadcrumb,
            'top_parent_id'=>$parent_id,
            'sub_category_id'=>$sub_category_id,
            'created_at'=>Helper::timeStamp()
        ]);
        return true;
    }

    static function createNewCollectionChildParent($parent_id,$breadcrumb,$checkIfTopParent, $lastId){
        $getPrevious=DB::table('collections')->where('sub_category_id',$parent_id)->first();
        $old=$getPrevious->collection;
        $full=$old.'/'.$breadcrumb;
        $insert=DB::table('collections')->where('sub_category_id',$parent_id)->insert([
            'collection'=>$full,
            'sub_category_id'=>$lastId,
            'top_parent_id'=>$getPrevious->top_parent_id,
            'created_at'=>Helper::timeStamp()
        ]);
        if($insert){
            echo "Inserted";
            return true;
        } 
        echo "Not Inserted";
        return false;
    }

    static function deleteFromCollectionTopParent($id){
        $fetchSubcategories=DB::table('category')->where(['parent_id'=>$id])->first();
        if($fetchSubcategories){
            return;
        }
        $delete=DB::table('collections')->where(['top_parent_id'=>$id])->delete();
        if($delete){
            return true;
        }
        return false;
    }
    static function deleteFromCollectionChildParent($id){
        $fetchSubcategories=DB::table('category')->where(['parent_id'=>$id])->first();
        if($fetchSubcategories){
            return;
        }
        $delete=DB::table('collections')->where(['sub_category_id'=>$id])->delete();
        if($delete){
            return true;
        }
        return false;
    }
}
