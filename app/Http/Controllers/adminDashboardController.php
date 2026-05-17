<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dashboardModel as dashboard;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class adminDashboardController extends Controller
{
    public function index(){
        $data['profile']=dashboard::fetchProfile();
        $data['tracking10']=dashboard::getTracking10();
        $data['inventoryCount']=DB::table('inventory')->count();
        $data['inventoryPageCount']=DB::table('labels')->count();
        $data['customerQueryCount']=DB::table('queries')->count();
        $data['latestQueries']=DB::table('queries')->orderBy('id','DESC')->take(3)->get();
        return view('admin.dashboard', $data);
    }

    public function allActivity(){
        $data['profile']=dashboard::fetchProfile();
        $data['tracking']=dashboard::getTracking();
        return view('admin.allActivity',$data);
    }
}
