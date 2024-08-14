<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class changesTrackerModel extends Model
{
    use HasFactory;

    static function insert($title, $email, $name){
        date_default_timezone_set(env('APPLICATION_TIMEZONE'));
        $str = date("Y/m/d H:i:s");
        $insert=DB::table("changes_tracker")->insert(
            [
                'change_title'=>$title,
                'changer_email'=>$email,
                'changer_name'=>$name,
                'created_at'=>date('d/F/Y H:i', strtotime($str))
            ]);
        if($insert){
            return true;
        }
            return false;
    }
}
