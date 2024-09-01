<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class indexController extends Controller
{
    public function index(){
        $data['web']=DB::table('web_settings')->first();
        return view('index',$data);
    }
}
