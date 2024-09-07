<?php 

namespace App\Helpers;

class Helper
{
    # Helper function that will be used as an alternative to asset function to return the app URL with public path
    public static function props($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }

    # Return the current date in Database Timestamp format according to the set Timezone from .env
    public static function timeStamp(){
        date_default_timezone_set(env('APPLICATION_TIMEZONE'));
        $result=date("Y-m-d H:i:s");
        return $result;
    }

    # Takes the current incoming DB timestamp & converts in into a pretty format as defined.
    public static function timeStampProcessed($timestamp){
        $result=date('F d, Y h:i A', strtotime($timestamp));
        return $result;
    }
}
