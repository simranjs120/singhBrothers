<?php

namespace App\Http\Controllers;
use App\Models\logoModel as logo;
use App\Models\dashboardModel as dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\changesTrackerModel as tracker;
use Illuminate\Support\Facades\File;

class logoController extends Controller
{
    public function index(){
        $data['profile'] = dashboard::fetchProfile();
        return view('admin.logo',$data);
    }
    public function submit(Request $request){
        Log::info("Logo change request by User ID: ",[Auth::id()]);
        $extension=$request->front_logo->extension();
        if($extension!="png"){
            Log::error("Logo change failed because of wrong extension");
            return redirect()->back()->with('error', 'Request Rejected, Wrong image extension, Only .png allowed !!');
        } 
        

        if($request->front_logo!=""){
        File::delete(public_path('assets/img/') . "logo.png");
        $front_logo_image = 'logo.' . $request->front_logo->extension();
        $move1=$request->front_logo->move(public_path('assets/img'), $front_logo_image);
        }

        if($request->favicon!=""){
        File::delete(public_path('assets/img/') . "favicon.png");
        $favicon_image = 'favicon.' . $request->favicon->extension();
        $move2=$request->favicon->move(public_path('assets/img'), $favicon_image);
        }

        if($request->admin_logo!=""){
        File::delete(public_path('admin/images/') . "logo.png");
        $admin_logo_image = 'logo.' . $request->admin_logo->extension();
        $move3=$request->admin_logo->move(public_path('admin/images'), $admin_logo_image);
        }

        if($request->front_footer_logo!=""){
        File::delete(public_path('assets/img/') . "logo-dark.png");
        $front_footer_logo_image = 'logo-dark.' . $request->front_footer_logo->extension();
        $move4=$request->front_footer_logo->move(public_path('assets/img'), $front_footer_logo_image);
        }

        # Entry for changes tracker start
        $data['profile'] = dashboard::fetchProfile();
        $changer_name = $data['profile']->name;
        $changer_email = $data['profile']->email;
        $changer_title = " made change to website logo part";
        $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
        if ($trackIt) {
            Log::info('Addition to tracker table success');
        } else {
            Log::error('Addition to tracker table failed');
        }
        # Enter for changes tracker end

        Log::error("Logo change request success");
        return redirect()->back()->with('success', 'Logo identity updated successfully.');
    }

}
