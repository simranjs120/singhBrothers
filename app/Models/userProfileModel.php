<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userProfileModel extends Model
{
    use HasFactory;

    static function updateWithoutPassword($name, $email, $password){
        $loggerId=Auth::id();
        $action=DB::table("users")->where("id", $loggerId)->update(['name'=>$name,'email'=>$email,'password'=>$password]);
        if($action){
            return true;
        }
        return false;
    }

    static function updateWithPassword($name, $email, $password){
        $loggerId=Auth::id();
        $password=Hash::make($password);
        $action=DB::table("users")->where("id", $loggerId)->update(['name'=>$name,'email'=>$email,'password'=>$password]);
        if($action){
            return true;
        }
        return false;
    }

    static function fetchProfileForPreviousPassword(){
        $loggerId=Auth::id();
        $action=DB::table("users")->where("id", $loggerId)->first();
        if($action){
            return $action;
        }
        return false;
    }
}
