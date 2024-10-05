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
        # Here we're only getting the inventory items assigned to the spotlight section, Based on inventory IDs, We'll fetch items from ajax on index page.
            $data['inner_section_spotlight']=DB::table('inner_section')->where(['status'=>1,'type'=>'spotlight'])->first();
            if(!$data['inner_section_spotlight']){
                $data['inventory_section_spotlight']=[];
            } else {
                $data['inventory_section_spotlight']=DB::table('inventory_section')->where(['section_id'=>$data['inner_section_spotlight']->id])->get();
            }
        # End Spotlight part
        

        # Deal with dynamic sections
            $data['inner_sections']=DB::table('inner_section')->where('status',1)->where('type','!=','spotlight')->get();
            if(!$data['inner_sections']){
                $data['inventory_section_dynamic']=[];
            } else {
                $dataArray=[];
                $resultArray=[];
                foreach($data['inner_sections'] as $row){
                    $dataArray['section_id']=$row->id;
                    $dataArray['section_type']=$row->type;
                    $dataArray['inventory_ids']=DB::table('inventory_section')->where(['section_id'=>$row->id])->get('inventory_id');
                    
                    # If there're no inventory items assigned to a section yet, it's useless to send that section, Hence only sending sections with data.
                    if(count($dataArray['inventory_ids'])>0){
                        $resultArray[]=$dataArray;
                    }
                }
                $data['inventory_section_dynamic']=json_encode($resultArray);
            }
        # Dynamic sections deal end
        return view('index',$data);
    }

    public function fetchSpotlightItems(Request $request){
        $ids=$request->ids;
        $countItems=count($ids);

        $embedArray=[];
        $result=[];
        for($i=0;$i<$countItems;$i++){
            $getInventory=DB::table('inventory')->where('id',$ids[$i])->first();
            $embedArray['thumbnailimg']=$getInventory->thumbnailimg;
            $embedArray['itemName']=$getInventory->itemName;
            $embedArray['strikerPrice']=$getInventory->strikerPrice;
            $embedArray['actualPrice']=$getInventory->actualPrice;
            $embedArray['offerBadge']=$getInventory->offerBadge;
            $result[]=$embedArray;
        }
        return json_encode([
            'data'=>$result,
            'countOfSpotlightInventory'=>count($result)
        ]);
    }

    public function fetchDynamicItems(Request $request){
        $array=json_decode($request->array);

        $incomingArray=[];
        $resultArray=[];
        
        # Now fetch data on the basis of "inventory_ids", Using nested loop.
        // $i=0;
        // foreach($array as $arrays){
        //     $getInventory=DB::table('inventory')->where('id',$ids[$i])->first();
        //     $embedArray['thumbnailimg']=$getInventory->thumbnailimg;
        //     $embedArray['itemName']=$getInventory->itemName;
        //     $embedArray['strikerPrice']=$getInventory->strikerPrice;
        //     $embedArray['actualPrice']=$getInventory->actualPrice;
        //     $embedArray['offerBadge']=$getInventory->offerBadge;
        //     $result[]=$embedArray;
        //     $i++;
        // }
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        die;
    }
}
