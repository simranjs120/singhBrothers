<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class dashboardModel extends Model
{
    use HasFactory;

    static function fetchProfile(){
        $loggerId=Auth::id();
        $fetchProfile=DB::table("users")->where("id",$loggerId)->first();
        if($fetchProfile){
            return $fetchProfile;
        }
        return false;
    }

    static function fetchMyActivity(){
        $loggerId=Auth::id();
        $fetchEmail=DB::table("users")->where("id",$loggerId)->first();
        $fetchMyActivity=DB::table("changes_tracker")->where("changer_email",$fetchEmail->email)->orderBy('id','DESC')->get();
        if($fetchMyActivity){
            return $fetchMyActivity;
        }
        return false;
    }
    static function fetchUsers(){
        $data=DB::table("users")->get();
        return $data;        
    }
    static function getTracking10(){
        $fetchTracking=DB::table("changes_tracker")->orderBy('id', 'DESC')->take(5)->get();
        if($fetchTracking){
            return $fetchTracking;
        }
        return false;
    }
    static function getTracking(){
        $fetchTracking=DB::table("changes_tracker")->orderBy('id', 'DESC')->get();
        if($fetchTracking){
            return $fetchTracking;
        }
        return false;
    }
}
