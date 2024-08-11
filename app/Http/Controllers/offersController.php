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

class offersController extends Controller
{
    public function index(){
        $data['profile']=dashboard::fetchProfile();
        return view('admin.offers', $data);
    }
}
