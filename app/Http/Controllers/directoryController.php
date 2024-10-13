<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use App\Models\dashboardModel as dashboard;
use App\Models\directoryModel as directory;
use App\Models\changesTrackerModel as tracker;

class directoryController extends Controller
{
    public function index(){
        $data['profile'] = dashboard::fetchProfile();
        $data['directory'] = directory::fetchDirectory();
        return view('admin.directory', $data);
    }
}
