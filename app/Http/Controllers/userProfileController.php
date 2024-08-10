<?php

namespace App\Http\Controllers;
use App\Models\dashboardModel as dashboard;
use App\Models\userProfileModel as userProfile;
use App\Models\changesTrackerModel as tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->back()->with('error','An error occured !! Please try again !!');
        }
       } else{
        $fetchProfileForPreviousPassword=userProfile::fetchProfileForPreviousPassword();
        $updateInfoWithoutPassword=userProfile::updateWithoutPassword($name, $email,$password=$fetchProfileForPreviousPassword->password);
        if($updateInfoWithoutPassword){
            Log::info('Profile Update Request Successfull for User ID: ',[Auth::id()]);
            return redirect()->back()->with('success','Your profile has been updated successfully !!');
        } else {
            Log::error('Profile Update Request Failed For User ID: ',[Auth::id()]);
            return redirect()->back()->with('error','An error occured !! Please try again !!');
        }
       } 
    }

    public function addNewUserRender(){
        $data['profile']=dashboard::fetchProfile();
        return view('admin.addUser', $data);
    }

    public function addNewUser(Request $request){
        Log::info('Request to create a new user by User ID: ',[Auth::id()]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'forgot_password_key'=>str_replace ('/', '', Hash::make($request->password)),
        ]);
        $create=event(new Registered($user));
        if($create){
            Log::info('New User created successfully by User ID: ',[Auth::id()]);
            # Entry for changes tracker
            $data['profile']=dashboard::fetchProfile();
            $changer_name=$data['profile']->name;
            $changer_email=$data['profile']->email;
            $changer_title=" created a new user";
            $trackIt=tracker::insert($changer_title, $changer_email, $changer_name);
            if($trackIt){
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Tracker End
            return redirect()->back()->with('success','New User has been created successfully !!');
        } else {
            Log::error('New user creation request failed by User ID: ',[Auth::id()]);
            return redirect()->back()->with('error','An error occured !! Please try again !!');
        }
    }
}
