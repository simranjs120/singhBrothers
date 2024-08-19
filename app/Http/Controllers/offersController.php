<?php

namespace App\Http\Controllers;
use App\Models\dashboardModel as dashboard;
use App\Models\userProfileModel as userProfile;
use App\Models\changesTrackerModel as tracker;
use App\Models\offersModel as offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class offersController extends Controller
{
    public function index()
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['offers'] = offers::fetchOffers();
        return view('admin.offers', $data);
    }

    public function submitOffers(Request $request)
    {
        Log::info('New offer creation request by User ID: ', [Auth::id()]);
        date_default_timezone_set(env('APPLICATION_TIMEZONE'));
        $str = date("Y/m/d H:i:s");
        # Offer Image 
        $imageName = "";
        if ($request->image != "") {
            $offerImageName = "offer-img-" . time();
            $imageName = $offerImageName . '.' . $request->image->extension();
            $moveOfferImg = $request->image->move(public_path('admin/offerImages'), $imageName);
            if (!$moveOfferImg) {
                Log::error('Offer image addition request failed: ', [$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload offer image !!');
            }
            Log::info('Offer image added for offer creation Request: ', [$request->except(['_token'])]);
        }

        $data = [
            "title" => $request->title,
            "image" => $imageName,
            "url" => $request->url,
            "auto_enable" => $request->auto_enable,
            "auto_disable" => $request->auto_disable,
            "type" => $request->type,
            "status" => 1,
            "created_at" => date('d/F/Y H:i', strtotime($str))
        ];

        $insert = offers::submitOffers($data);

        if ($insert) {
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " just created a new offer: " . $request->title;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            Log::info('Offer added successfully for request: ', [$request->except(['_token'])]);
            return redirect()->back()->with('success', 'New offer has been created successfully');
        }
        Log::error('Error, could not add the new offer for request: ', [$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured, Please try again !!');
    }

    public function changeOfferStatus($status, $id)
    {
        Log::info('Offer status update request by: ', [Auth::id()]);
        $status = offers::changeStatus($status, $id);
        $previousData = offers::getOfferWithId($id);
        if ($status) {
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            if ($status == 0) {
                $changer_title = " changed the status to In-Active for offer ID/Name: " . $id . '/' . $previousData->title;
            } else if ($status == 1) {
                $changer_title = " changed the status to Active for offer ID/Name: " . $id . '/' . $previousData->title;
            }
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            Log::info('Status update for Offer ID: ', [$id]);
            return redirect()->back()->with('success', 'Offer status has been updated successfully');
        }
        Log::error('Error occured while updating status for Offer ID: ', [$id]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function editOffers(Request $request)
    {
        Log::info('offer edit request by User ID: ', [Auth::id()]);
        $previousData = offers::getOfferWithId($request->id);
        date_default_timezone_set(env('APPLICATION_TIMEZONE'));
        $str = date("Y/m/d H:i:s");
        # Offer Image 
        $imageName = $previousData->image;
        if ($request->image != "") {
            File::delete(public_path('admin/offerImages/') . $previousData->image);
            $offerImageName = "offer-img-" . time();
            $imageName = $offerImageName . '.' . $request->image->extension();
            $moveOfferImg = $request->image->move(public_path('admin/offerImages'), $imageName);
            if (!$moveOfferImg) {
                Log::error('Offer image addition request failed: ', [$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload offer image !!');
            }
            Log::info('Offer image added for offer creation Request: ', [$request->except(['_token'])]);
        }

        $data = [
            "title" => $request->title,
            "image" => $imageName,
            "url" => $request->url,
            "auto_enable" => $request->auto_enable,
            "auto_disable" => $request->auto_disable,
            "type" => $request->type,
            "status" => $previousData->status,
            "created_at" => date('d/F/Y H:i', strtotime($str))
        ];
        $update = offers::editInventory($request->id, $data);
        if ($update) {
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " just updated an offer: " . $request->title;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            Log::info('Offer updated successfully for request: ', [$request->except(['_token'])]);
            return redirect()->back()->with('success', 'Offer has been updated successfully');
        }
        Log::error('Error, could not update the offer for request: ', [$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured, Please try again !!');
    }

    public function deleteOffers($id)
    {
        $previousData = offers::getOfferWithId($id);
        File::delete(public_path('admin/offerImages/') . $previousData->image);
        $deleteData = offers::deleteData($id);
        if ($deleteData) {
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " deleted an offer: " . $previousData->title;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            Log::info('Offer deleted successfully for request: ', [$previousData->title]);
            return redirect()->back()->with('success', 'Offer has been deleted successfully');
        }
        Log::error('Error, could not delete the offer for request: ', [$previousData->title]);
        return redirect()->back()->with('error', 'An error occured, Please try again !!');
    }

    public function autoEnable(){
        date_default_timezone_set(env('APPLICATION_TIMEZONE')); 
        $data=offers::getDataForAutoManage();
        $currentTime=date("Y-m-d H:i");
        foreach($data as $data){
            if(str_replace('T',' ',$data->auto_enable)==$currentTime){
                $enable=offers::autoChange($data->id,1);
                if($enable){
                    Log::info('Status AUTO ENABLED for ID: ',[$data->id]);
                }
            }
        }
    }
    public function autoDisable(){
        date_default_timezone_set(env('APPLICATION_TIMEZONE')); 
        $data=offers::getDataForAutoManage();
        $currentTime=date("Y-m-d H:i");
        foreach($data as $data){
            if(str_replace('T',' ',$data->auto_disable)==$currentTime){
                $enable=offers::autoChange($data->id,0);
                if($enable){
                    Log::info('Status AUTO DISABLED for ID: ',[$data->id]);
                }
            }
        }
    }
}
