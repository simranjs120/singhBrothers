<?php 

namespace App\Helpers;

class Helper
{
    # Helper function that will be used as an alternative to asset function to return the app URL with public path
    public static function props($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}
