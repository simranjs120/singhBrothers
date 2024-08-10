<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class landingSectionModel extends Model
{
    use HasFactory;

    static function getNavTabs(){
        $data=DB::table('web_settings')->first([
            'nav_tab_1','nav_tab_1_link',
            'nav_tab_2','nav_tab_2_link',
            'nav_tab_3','nav_tab_3_link',
            'nav_tab_4','nav_tab_4_link',
            'nav_tab_5','nav_tab_5_link',
            'nav_tab_6','nav_tab_6_link'
        ]);
        return $data;
    }

    static function getHeadings(){
        $data=DB::table('web_settings')->first([
            'title','title_color',
            'tagline','search_line'
        ]);
        return $data;
    }

    static function configureNavTab($id,$tabName,$tabLink){
        $update=NULL;
        if($id==1){
            $update=DB::table('web_settings')->update(['nav_tab_1'=>$tabName,'nav_tab_1_link'=>$tabLink]);
        }
        if($id==2){
            $update=DB::table('web_settings')->update(['nav_tab_2'=>$tabName,'nav_tab_2_link'=>$tabLink]);
        }
        if($id==3){
            $update=DB::table('web_settings')->update(['nav_tab_3'=>$tabName,'nav_tab_3_link'=>$tabLink]);
        }
        if($id==4){
            $update=DB::table('web_settings')->update(['nav_tab_4'=>$tabName,'nav_tab_4_link'=>$tabLink]);
        }
        if($id==5){
            $update=DB::table('web_settings')->update(['nav_tab_5'=>$tabName,'nav_tab_5_link'=>$tabLink]);
        }
        if($id==6){
            $update=DB::table('web_settings')->update(['nav_tab_6'=>$tabName,'nav_tab_6_link'=>$tabLink]);
        }
        if($update){
            return true;
        }
        return false;
    }

    static function configureLandingHeadings($title,$titleColor,$tagline,$search_line){
        $update=DB::table('web_settings')->update([
            'title'=>$title,
            'title_color'=>$titleColor,
            'tagline'=>$tagline,
            'search_line'=>$search_line
        ]);
        if($update){
            return true;
        }
        return false;
    }
}
