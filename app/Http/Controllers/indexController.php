<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class indexController extends Controller
{
    public function index(){
        $data['web']=DB::table('web_settings')->first();
        $data['category']=DB::table('category')->where('status',1)->get();

        # Deal with Spotlight
        $data['inner_section_spotlight']=DB::table('inner_section')->where(['status'=>1,'type'=>'spotlight'])->first();
        $data['inventory_section_spotlight']=DB::table('inventory_section')->where(['section_id'=>$data['inner_section_spotlight']->id])->get();


        // $data['inventory_for_spotlight']=DB::table('inventory')->where(['id'=>$data['inventory_section_spotlight']->inventory_id])->get();
        # End Spotlight part

        return view('index',$data);
    }
}
