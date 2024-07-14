<?php

namespace App\Http\Controllers;
use App\Models\dashboardModel as dashboard;
use App\Models\userProfileModel as userProfile;
use App\Models\changesTrackerModel as tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class userProfileController extends Controller
{
    public function index(){
        $data['profile']=dashboard::fetchProfile();
        return view('admin.myProfile', $data);
    }
    public function updateProfile(Request $request){
       Log::info('Profile Update Request For User ID: ',[Auth::id()]);
       $name=$request->name;
       $email=$request->email;
       $password=$request->password;
       if($password!=""){
        $updateInfoWithPassword=userProfile::updateWithPassword($name, $email, $password);
        if($updateInfoWithPassword){
            Log::info('Profile Update Request Successfull for User ID: ',[Auth::id()]);
            return redirect()->back()->with('success','Your profile has been updated successfully !!');
        } else {
            Log::error('Profile Update Request Failed For User ID: ',[Auth::id()]);
            return redirect()->back()->with('error','An error occured, Please contact the developer !!');
        }
       } else{
        $updateInfoWithoutPassword=userProfile::updateWithoutPassword($name, $email);
        if($updateInfoWithoutPassword){
            Log::info('Profile Update Request Successfull for User ID: ',[Auth::id()]);
            return redirect()->back()->with('success','Your profile has been updated successfully !!');
        } else {
            Log::error('Profile Update Request Failed For User ID: ',[Auth::id()]);
            return redirect()->back()->with('error','An error occured, Please contact the developer !!');
        }
       } 
    }
}
