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
        return view('admin.category', $data);
    }

    public function create(Request $request){
        $data['profile']=dashboard::fetchProfile();
        $payload=$request->except('_token');
            Log::info('New Category Addition Request By: ',[$data['profile']->name]);
            Log::info('Category Name: ',[$payload['category']]);
            $insertCategory=category::insertCategory($payload);
            if($insertCategory==1){
                Log::info('Category Inserted Successfully');
                # Entry for changes tracker
                $categoryName=$payload['category'];
                $changer_name=$data['profile']->name;
                $changer_email=$data['profile']->email;
                $changer_title=$changer_name." just added a new category: ".$categoryName;
                $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
                if($trackIt){
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                return redirect()->back()->with('success','New category has been added to the system successfully !!');
            } else if($insertCategory==2) {
                Log::error('Category Insertion failed, Record already exists');
                return redirect()->back()->with('error','Cannot create, this category already exists in the system !!');
            } else if($insertCategory==0) {
                Log::error('Category Insertion failed');
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
                $changer_title=$changer_name." changed the status to In-Active for category ID: ".$id;
            } else if($status==1) {
                $changer_title=$changer_name." changed the status to Active for category ID: ".$id;
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

    public function deleteCategory($id){
        $data['profile']=dashboard::fetchProfile();
        Log::info('Category Deletion request for category ID: ',[$id]);
        $changestatus=category::deleteCategory($id);
        if($changestatus==1){
            # Entry for changes tracker
            $changer_name=$data['profile']->name;
            $changer_email=$data['profile']->email;
                $changer_title=$changer_name." Just Deleted a category: ".$id;
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

}
