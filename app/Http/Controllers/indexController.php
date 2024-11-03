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
        $data['inventoryItemsCount']=DB::table('inventory')->count();
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
                    $dataArray['count_inventory_ids']=DB::table('inventory_section')->where(['section_id'=>$row->id])->count();

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
            $embedArray['salePitch']=$getInventory->salePitch;
            $embedArray['offerBadge']=$getInventory->offerBadge;
            $embedArray['importantNote']=$getInventory->importantNote;
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
        
        /* Fetching data on the basis of "inventory_ids" key, Using nested loop. Suppose there are 2 items in the array, so each item array will have a nested array, & that nest
        would contain multiple "inventory_id" keys which that section contains, so first we'll run a foreach to iterate sections, and then a nested array inside to fetch the 
        "inventory_id" of that iterated section, based on IDS, we'll fetch details of those items & send them to view via a new array. */
        $i=0;
        foreach($array as $arrays){
            $incomingArray['section_id']=$arrays->section_id;
            $incomingArray['section_data']=DB::table('inner_section')->where('id', $arrays->section_id)->first();

            # Re-initialise the array so that there are no garbage values remaining in the second iteration.
            $inventoryDetails=[];
            for($j=0;$j<$arrays->count_inventory_ids;$j++){
                # Fetch inventory data
                $inventory = DB::table('inventory')->where(['id'=>$arrays->inventory_ids[$j]->inventory_id,'status'=>1])->first();
                
                # Confirm that the item is not repeated 2 times, If an item is already in array & is repeated, This boolean will omit the item.
                if($inventory && !in_array($inventory,$inventoryDetails)){
                    # Add the fetched inventory details to the inventoryDetails array
                    $inventoryDetails[] = $inventory;
                }
            }
            $incomingArray['inventory_ids'] = $inventoryDetails;
            $resultArray[]=$incomingArray;
            $i++;
        }

        return json_encode([
            'data'=>$resultArray,
            'countOfDynamicItems'=>count($resultArray)
        ]);
    }

    public function fetchItems($inventory,$category,$sub){
        $data['web']=DB::table('web_settings')->first();
        $data['item']=DB::table('inventory')->where('id',base64_decode($inventory))->first();
        $data['relatedItems']=DB::table('inventory')
        ->where(['category_id'=>base64_decode($category),'status'=>1])
        ->where('id','!=',$data['item']->id)->take('3')->get();
        return view('listing',$data);
    }
    public function labelPage($key){
        $getLabel=DB::table('labels')->where('unique_hash',$key)->first();
        if($getLabel->status==0){
            return abort(404);
        }
        $data['LabelName']=$getLabel->name;
        $items=DB::table('label_inventory')->where('label_id',$getLabel->id)->get('inventory_id');
        // print_r($items);
        // die;
        $embedArray=[];
        $result=[];
        for($i=0;$i<count($items);$i++){
            $getInventory=DB::table('inventory')->where('id',$items[$i]->inventory_id)->first();
            $embedArray['id']=$getInventory->id;
            $embedArray['category_id']=$getInventory->category_id;
            $embedArray['sub_category_id']=$getInventory->sub_category_id;
            $embedArray['thumbnailimg']=$getInventory->thumbnailimg;
            $embedArray['itemName']=$getInventory->itemName;
            $embedArray['strikerPrice']=$getInventory->strikerPrice;
            $embedArray['actualPrice']=$getInventory->actualPrice;
            $embedArray['salePitch']=$getInventory->salePitch;
            $embedArray['offerBadge']=$getInventory->offerBadge;
            $embedArray['importantNote']=$getInventory->importantNote;
            $result[]=$embedArray;
        }
        $data['inventory']=$result;
        $data['web']=DB::table('web_settings')->first();
        return view('labels',$data);
    }

    public function search(){
        $data['web']=DB::table('web_settings')->first();
        if(request()->has('queryString')){
            $query=request()->get('queryString');
            $numberOfWords=$this->get_num_of_words($query);
            $wordsArray = $this->get_words_array($query);
            for($i=0;$i<$numberOfWords;$i++){
                $getInventory=DB::table('inventory')->where('itemName', 'like', '%' . $wordsArray[$i] . '%')->first();  
                if(empty($getInventory)){
                    break;
                }
                $embedArray['id']=$getInventory->id;
                $embedArray['category_id']=$getInventory->category_id;
                $embedArray['sub_category_id']=$getInventory->sub_category_id;
                $embedArray['thumbnailimg']=$getInventory->thumbnailimg;
                $embedArray['itemName']=$getInventory->itemName;
                $embedArray['strikerPrice']=$getInventory->strikerPrice;
                $embedArray['actualPrice']=$getInventory->actualPrice;
                $embedArray['salePitch']=$getInventory->salePitch;
                $embedArray['offerBadge']=$getInventory->offerBadge;
                $embedArray['importantNote']=$getInventory->importantNote;
                $result[]=$embedArray;
            }
            if(!empty($result)){
                $data['inventory']=$result;
            } else {
                $data['notFound']="No Results Found for '".$query."'";
            }
            $data['resultFor']=$query;
            return view('search',$data);
        } 
        return abort(404);
    }

// Function to count the words
function get_num_of_words($string) {
    $str = trim($string);
      while (substr_count($str, "  ") > 0) {
        $str = str_replace("  ", " ", $str);
    }
      return substr_count($str, " ")+1;
}
function get_words_array($string) {
    // Trim the string to remove leading and trailing whitespaces
    $str = trim($string);
    
    // Replace multiple spaces with a single space
    while (substr_count($str, "  ") > 0) {
        $str = str_replace("  ", " ", $str);
    }

    // Split the string by spaces to create an array of words
    $wordsArray = explode(" ", $str);
    
    // Return the array of words
    return $wordsArray;
}
}
