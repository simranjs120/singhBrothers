<?php

namespace App\Http\Controllers;
use App\Models\labelsModel as labels;
use Illuminate\Http\Request;
use App\Models\dashboardModel as dashboard;
use App\Models\inventoryModel as inventory;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class labelsController extends Controller
{
    public function index(){
        $data['profile'] = dashboard::fetchProfile();
        $data['label'] = labels::fetchLabels();
        return view('admin.labels',$data);
    }

    public function fetchAjax(Request $request){
        $id=$request->id;
        $label=labels::fetchLabels();
        $selectedForId=labels::selectedForId($id);
        return json_encode([
            'allLabels'=>$label,
            'selected'=>$selectedForId,
            'countOfTotalLabels'=>count($label)
        ]);

    }
    public function submitLabels(Request $request){
        Log::info('New Label creation request by user ID: ',[Auth::id()]);
        $name=$request->name;
        $status=$request->status;
        $data=[
            'name'=>$name,
            'url'=>str_replace('/public',"",Helper::props(base64_encode(time()))),
            'unique_hash'=> time(),
            'status'=>$status,
            'created_at'=>Helper::timeStamp()
        ];
        $insert=labels::insertData($data);
        if($insert){
            Log::info('Label creation success for payload: ',[$request->except(['_token'])]);
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " added a new label named as: " . $name;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            return redirect()->back()->with('success', 'New label has been created successfully');
        }
        Log::error('Error occured while creating label for payload: ',[$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function editLabel(Request $request){
        Log::info('Label edit request by user ID: ',[Auth::id()]);
        $name=$request->name;
        $id=$request->id;
        $edit=labels::editData($name,$id);
        if($edit){
            Log::info('Label Edit success, New Name: ',[$name]);
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " edited a label, New Name: " . $name;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            return redirect()->back()->with('success', 'Label name has been edited successfully');
        }
        Log::error('Error occured while editing label for payload: ',[$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function changeLabelStatus($status,$id){
        Log::info('Label status update request by user ID: ',[Auth::id()]);
        $updateStatus=labels::changeLabelStatus($status,$id);
        $previousData=labels::getLabelWithId($id);
        if($updateStatus){
             # Entry for changes tracker start
             $data['profile'] = dashboard::fetchProfile();
             $changer_name = $data['profile']->name;
             $changer_email = $data['profile']->email;
             if ($status == 0) {
                 $changer_title = " changed the status to In-Active for label ID/Name: " . $id . '/' . $previousData->name;
             } else if ($status == 1) {
                 $changer_title = " changed the status to Active for label ID/Name: " . $id . '/' . $previousData->name;
             }
             $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
             if ($trackIt) {
                 Log::info('Addition to tracker table success');
             } else {
                 Log::error('Addition to tracker table failed');
             }
             # Enter for changes tracker end
            Log::info('Status updated for label ID: ',[$id]);
            return redirect()->back()->with('success', 'Label status has been updated successfully');
        }
        Log::error('Error occured while updating status for Label ID: ',[$id]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function deleteLabel($id){
        Log::info('Label delete request by user ID: ',[Auth::id()]);
        $previousData=labels::getLabelWithId($id);
        $delete=labels::deleteLabel($id);
        if($delete){
             # Entry for changes tracker start
             $data['profile'] = dashboard::fetchProfile();
             $changer_name = $data['profile']->name;
             $changer_email = $data['profile']->email;
             $changer_title = " delete the label ID/Name: " . $id . '/' . $previousData->name;
             $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
             if ($trackIt) {
                 Log::info('Addition to tracker table success');
             } else {
                 Log::error('Addition to tracker table failed');
             }
             # Enter for changes tracker end
            Log::info('Label Deleted ID: ',[$id]);
            return redirect()->back()->with('success', 'Label has been deleted successfully');
        }
        Log::error('Error occured while deleting Label ID: ',[$id]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }
}
