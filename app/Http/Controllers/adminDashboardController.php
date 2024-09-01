<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dashboardModel as dashboard;
use App\Helpers\Helper;

class adminDashboardController extends Controller
{
    public function index(){
        $data['profile']=dashboard::fetchProfile();
        $data['tracking10']=dashboard::getTracking10();
        return view('admin.dashboard',$data);
    }

    public function allActivity(){
        $data['profile']=dashboard::fetchProfile();
        $data['tracking']=dashboard::getTracking();
        return view('admin.allActivity',$data);
    }
}
