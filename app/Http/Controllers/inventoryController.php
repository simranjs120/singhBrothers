<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dashboardModel as dashboard;
use App\Models\inventoryModel as inventory;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use Illuminate\Support\Facades\Log;

class inventoryController extends Controller
{
    public function index(Request $request){
        $data['profile'] = dashboard::fetchProfile();
        return view('admin.inventory',$data);
    }

    public function addInventory(){
        $data['profile'] = dashboard::fetchProfile();
        $data['collections']=inventory::getCollections();
        return view('admin.addInventory',$data);
    }
}
