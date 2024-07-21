<?php

namespace App\Http\Controllers;
use App\Models\dashboardModel as dashboard;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class categoryController extends Controller
{
    public function index(Request $request){
        $data['profile']=dashboard::fetchProfile();
        $data['categoryData']=category::fetchCategories();
        $data['subCategoryData']=category::fetchSubCategories();
        return view('admin.category', $data);
    }

    public function create(Request $request){
        $data['profile']=dashboard::fetchProfile();
        $payload=$request->except('_token');
            Log::info('New Category Addition Request By: ',[$data['profile']->name]);
            Log::info('Category Name: ',[$payload['category']]);
            $insertCategory=category::insertCategory($payload);
            if($insertCategory==1){
                Log::info('Category Inserted Successfully',[$payload]);
                # Entry for changes tracker
                $categoryName=$payload['category'];
                $changer_name=$data['profile']->name;
                $changer_email=$data['profile']->email;
                $changer_title=" just added a new category: ".$categoryName;
                $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
                if($trackIt){
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                return redirect()->back()->with('success','New category has been added to the system successfully !!');
            } else if($insertCategory==2) {
                Log::error('Category Insertion failed, Record already exists',[$payload]);
                return redirect()->back()->with('error','Cannot create, this category already exists in the system !!');
            } else if($insertCategory==0) {
                Log::error('Category Insertion failed',[$payload]);
                return redirect()->back()->with('error','An error occured while adding the new category, Kindly contact Developer !!');
            }
    }

    public function changeStatus($id,$status){
        $data['profile']=dashboard::fetchProfile();
        Log::info('Category Status change request for category ID,Status: ',[$id,$status]);
        $changestatus=category::changeStatus($id,$status);
        if($changestatus){
            # Entry for changes tracker
            $changer_name=$data['profile']->name;
            $changer_email=$data['profile']->email;
            if($status==0){
                $changer_title=" changed the status to In-Active for category ID: ".$id;
            } else if($status==1) {
                $changer_title=" changed the status to Active for category ID: ".$id;
            }
            $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
            if($trackIt){
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Tracker End
            Log::info('Status change successfull for category ID: ',[$id]);
            return redirect()->back()->with('success','Status Changed Successfully !!');
        } else {
            Log::error('Status change failed for category ID: ',[$id]);
            return redirect()->back()->with('error','An error occured, Kindly contact Developer !!');
        }
    }

    public function changeHierarchyStatus($id,$status){
        $data['profile']=dashboard::fetchProfile();
        Log::info('Hierarchy Status change request for Hierarchy ID,Status: ',[$id,$status]);
        $changestatus=category::changeHierarchyStatus($id,$status);
        if($changestatus){
            # Entry for changes tracker
            $changer_name=$data['profile']->name;
            $changer_email=$data['profile']->email;
            if($status==0){
                $changer_title=" changed the status to In-Active for Hierarchy ID: ".$id;
            } else if($status==1) {
                $changer_title=" changed the status to Active for Hierarchy ID: ".$id;
            }
            $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
            if($trackIt){
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Tracker End
            Log::info('Status change successfull for Hierachy ID: ',[$id]);
            return redirect()->back()->with('success','Status Changed Successfully !!');
        } else {
            Log::error('Status change failed for Hierachy ID: ',[$id]);
            return redirect()->back()->with('error','An error occured, Kindly contact Developer !!');
        }
    }
    public function deleteCategory($id){
        $data['profile']=dashboard::fetchProfile();
        Log::info('Category Deletion request for category ID: ',[$id]);
        $changestatus=category::deleteCategory($id);
        if($changestatus==1){
            # Entry for changes tracker
            $changer_name=$data['profile']->name;
            $changer_email=$data['profile']->email;
                $changer_title=" Just Deleted a category: ".$id;
            $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
            if($trackIt){
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Tracker End
            Log::info('Deletion successfull for category ID: ',[$id]);
            return redirect()->back()->with('success','Category Deleted Successfully !!');
        } else if($changestatus==2){
            Log::error('Deletion failed for category because sub-category exists, Category ID: ',[$id]);
            return redirect()->back()->with('error','A sub-category exists for this category, Please delete sub-categories first !!');
        } else if($changestatus==0){
            Log::error('Deletion failed for category ID: ',[$id]);
            return redirect()->back()->with('error','An error occured, Kindly contact Developer !!');
        }
    }

    public function deleteHierarchy($id){
        $data['profile']=dashboard::fetchProfile();
        Log::info('Hierarchy Deletion request for category ID: ',[$id]);
        $changestatus=category::deleteHierarchy($id);
        if($changestatus==1){
            # Entry for changes tracker
            $changer_name=$data['profile']->name;
            $changer_email=$data['profile']->email;
                $changer_title=" Just Deleted a Hierarchy: ".$id;
            $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
            if($trackIt){
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Tracker End
            Log::info('Deletion successfull for Hierarchy ID: ',[$id]);
            return redirect()->back()->with('success','Hierarchy Deleted Successfully !!');
        } else if($changestatus==2){
            Log::error('Deletion failed for category because sub-category exists, Category ID: ',[$id]);
            return redirect()->back()->with('error','A sub-category exists for this category, Please delete sub-categories first !!');
        } else if($changestatus==0){
            Log::error('Deletion failed for Hierarchy ID: ',[$id]);
            return redirect()->back()->with('error','An error occured, Kindly contact Developer !!');
        }
    }

    public function fetchSubCategories(Request $request){
        $id=$request->id;
        $subCategoryCount=category::subCategoryCount($id);
        $subCategoryData=category::fetchSubCategoryData($id);
        return json_encode([
            'count'=> $subCategoryCount,
            'data'=>$subCategoryData
        ]);
    }
    public function submitSubCategories(Request $request){
        $data['profile']=dashboard::fetchProfile();
        $data=$request->except(['_token']);
        $action=category::submitSubCategories($data);
        if($action){
            $data['profile']=dashboard::fetchProfile();
            Log::info('sub-Category Inserted Successfully',[$data]);
                # Entry for changes tracker
                $categoryName=$data['sub_category'];
                $changer_name=$data['profile']->name;
                $changer_email=$data['profile']->email;
                $changer_title=" just added a new Sub-category: ".$categoryName;
                $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
                if($trackIt){
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                return redirect()->back()->with('success','New Sub-category has been added to the system successfully !!');
        } 
        Log::error('Sub-category Insertion failed, Payload data: ',[$data]);
        return redirect()->back()->with('error','An error occured while adding the new Sub-category, Kindly contact Developer !!');
    }

    public function getHierarchies($id){
        $data['profile']=dashboard::fetchProfile();
        $data['categoryName']=category::getCategoryName($id);
        $data['subCategoryData']=category::fetchSubCategoryData($id);
        $data['hierachyData']=category::hierachyData($id);
        $data['parent_id']=$id;
        return view('admin.hierarchy',$data);
    }

    public function submitHierarchy(Request $request){
        $category_id=$request->category_id;
        $subcategory_id=$request->subcategory_id;
        $category_name=$request->category_name;
        $getSubcategoryById=category::getSubcategoryById($subcategory_id);
        $breadcrumb=$category_name.'/'.$getSubcategoryById->sub_category;
        $insert=category::submitHierarchy($category_id,$subcategory_id,$breadcrumb);
        if($insert){
            $data['profile']=dashboard::fetchProfile();
            Log::info('Hierarchy First child Inserted Successfully',[$breadcrumb]);
                # Entry for changes tracker
                $changer_name=$data['profile']->name;
                $changer_email=$data['profile']->email;
                $changer_title=" just added a new First Child: ".$breadcrumb;
                $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
                if($trackIt){
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                return redirect()->back()->with('success','New First Child has been added to the system successfully !!');
        }
        Log::error('Hierarchy First child Insertion failed, Payload data: ',[$breadcrumb]);
        return redirect()->back()->with('error','An error occured, Kindly contact Developer !!');
    }
    public function editHierarchy(Request $request){
        $id=$request->id;
        $prewritten=$request->prewritten;
        $subcategory_id=$request->subcategory_id;
        $getSubcategoryById=category::getSubcategoryById($subcategory_id);
        $breadcrumb=$prewritten.'/'.$getSubcategoryById->sub_category;
        $update=category::updateHierarchy($id,$breadcrumb);
        if($update){
            $data['profile']=dashboard::fetchProfile();
            Log::info('Hierarchy First child updated Successfully',[$breadcrumb]);
                # Entry for changes tracker
                $changer_name=$data['profile']->name;
                $changer_email=$data['profile']->email;
                $changer_title=" just added a new First Child: ".$breadcrumb;
                $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
                if($trackIt){
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                return redirect()->back()->with('success','First Child has been updated successfully !!');
        }
        Log::error('Hierarchy First child Insertion failed, Payload data: ',[$breadcrumb]);
        return redirect()->back()->with('error','An error occured, Kindly contact Developer !!');
    }
}
