<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dashboardModel as dashboard;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use Illuminate\Support\Facades\Log;

class inventoryController extends Controller
{
    public function index(Request $request){
        $data['profile'] = dashboard::fetchProfile();
        return view('admin.inventory',$data);
    }
}
