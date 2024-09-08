<?php

namespace App\Http\Controllers;
use App\Models\dashboardModel as dashboard;
use App\Models\innerSectionModel as innerSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\changesTrackerModel as tracker;

class innerSectionController extends Controller
{
    public function index(Request $request){
        $data['profile'] = dashboard::fetchProfile();
        $data['innerSection']=innerSection::fetchSections();
        return view('admin.innerSection',$data);
    }

    public function submitSection(Request $request){
        Log::info('New section addition request by ID: ',[Auth::id()]);
        $payload=$request->except(['_token']);
        $dataIns=innerSection::addData($payload);
        if($dataIns){
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " created a new section: " . $request->name;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            Log::info('Section added successfully for request: ', [$request->except(['_token'])]);
            return redirect()->back()->with('success', 'New section has been created successfully');
        }
        Log::error('Error, could not add the new section for request: ', [$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured, Please try again !!');
    }

    public function editSection(Request $request){
        Log::info('New section edit request by ID: ',[Auth::id()]);
        $payload=$request->except(['_token']);
        $dataIns=innerSection::editData($payload,$payload['id']);
        if($dataIns){
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " edited a section: " . $request->name;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            Log::info('Section edited successfully for request: ', [$request->except(['_token'])]);
            return redirect()->back()->with('success', 'Section has been edited successfully');
        }
        Log::error('Error, could not edit the section for request: ', [$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured, Please try again !!');
    }

    public function editStatusSection($status,$id){
        Log::info('New section status edit request by ID: ',[Auth::id()]);
        $status = innerSection::changeStatus($status, $id);
        $previousData = innerSection::getSectionWithId($id);
        if ($status) {
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            if ($status == 0) {
                $changer_title = " changed the status to In-Active for section Name: ".$previousData->name;
            } else if ($status == 1) {
                $changer_title = " changed the status to Active for section Name: ".$previousData->name;
            }
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            Log::info('Status update for section ID: ', [$id]);
            return redirect()->back()->with('success', 'Section status has been updated successfully');
        }
        Log::error('Error occured while updating status for Section ID: ', [$id]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function deleteSection($id)
    {
        Log::info('New section delete request by ID: ',[Auth::id()]);
        $previousData = innerSection::getSectionWithId($id);
        $deleteData = innerSection::deleteData($id);
        if ($deleteData) {
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " deleted a section: " . $previousData->name;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Entry for changes tracker end
            Log::info('Section deleted successfully for request: ', [$previousData->name]);
            return redirect()->back()->with('success', 'Section has been deleted successfully');
        }
        Log::error('Error, could not delete the section for request: ', [$previousData->name]);
        return redirect()->back()->with('error', 'An error occured, Please try again !!');
    }
}
