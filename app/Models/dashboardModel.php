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
}
