<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dashboardModel as dashboard;

class adminDashboardController extends Controller
{
    public function index(){
        $data['profile']=dashboard::fetchProfile();
        return view('admin.dashboard',$data);
    }
}
