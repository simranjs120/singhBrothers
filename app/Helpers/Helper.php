<?php 

namespace App\Helpers;

class Helper
{
    # Helper function that will be used as an alternative to asset function to return the app URL with public path
    public static function props($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }

    public static function timeStamp(){
        date_default_timezone_set(env('APPLICATION_TIMEZONE'));
        $str = date("Y/m/d H:i:s");
        $result=date('F d, Y h:i A', strtotime($str));
        return $result;
    }
}
