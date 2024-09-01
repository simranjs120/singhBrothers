<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class changesTrackerModel extends Model
{
    use HasFactory;

    static function insert($title, $email, $name){
        $insert=DB::table("changes_tracker")->insert(
            [
                'change_title'=>$title,
                'changer_email'=>$email,
                'changer_name'=>$name,
                'created_at'=>Helper::timeStamp(),
            ]);
        if($insert){
            return true;
        }
            return false;
    }
}
