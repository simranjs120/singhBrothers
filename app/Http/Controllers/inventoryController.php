<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dashboardModel as dashboard;
use App\Models\inventoryModel as inventory;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use App\Helpers\Helper as Helper;
use Illuminate\Support\Facades\Log;

class inventoryController extends Controller
{
    public function index(Request $request){
        $data['profile'] = dashboard::fetchProfile();
        $data['inventory']=inventory::getInventory();
        return view('admin.inventory',$data);
    }

    public function addInventory(){
        $data['profile'] = dashboard::fetchProfile();
        $data['collections']=inventory::getCollections();
        return view('admin.addInventory',$data);
    }

    public function submitInventory(Request $request){
        // These 3 variables are for 3 product images, Product images are optional, So declaring them here as blank value to avoid null exception.
        $imageName1="";
        $imageName2="";
        $imageName3="";

        Log::info('New Inventory Addition Request: ',[$request->except(['_token'])]);

        # Thumbnail Image 
        $thumbnailImageName = "thumbnail-img-" . time();
        $imageName = $thumbnailImageName . '.' . $request->thumbnailimg->extension();
        $moveThumbnailImg=$request->thumbnailimg->move(public_path('admin/inventoryImages'), $imageName);
        if(!$moveThumbnailImg){
            Log::error('Thumbnail addition FAILED for Inventory Addition Request: ',[$request->except(['_token'])]);
            return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload thumbnail image !!');
        }
        Log::info('Thumbnail added for Inventory Addition Request: ',[$request->except(['_token'])]);


        if($request->productimg1!=""){
            # Product Image 1
            $productImage1 = "product-img-1-" . time();
            $imageName1 = $productImage1 . '.' . $request->productimg1->extension();
            $moveProductImg1=$request->productimg1->move(public_path('admin/inventoryImages'), $imageName1);
            if(!$moveProductImg1){
                Log::error('Product Image 1 FAILED for Inventory Addition Request: ',[$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload product image 1 !!');
            }
            Log::info('Product Image 1 added for Inventory Addition Request: ',[$request->except(['_token'])]);
        }

        if($request->productimg2!=""){
            # Product Image 2
            $productImage2 = "product-img-2-" . time();
            $imageName2 = $productImage2 . '.' . $request->productimg2->extension();
            $moveProductImg2=$request->productimg2->move(public_path('admin/inventoryImages'), $imageName2);
            if(!$moveProductImg2){
                Log::error('Product Image 2 FAILED for Inventory Addition Request: ',[$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload product image 2 !!');
            }
            Log::info('Product Image 2 added for Inventory Addition Request: ',[$request->except(['_token'])]);
        }

        if($request->productimg3!=""){
            # Product Image 3
            $productImage3 = "product-img-3-" . time();
            $imageName3 = $productImage3 . '.' . $request->productimg3->extension();
            $moveProductImg3=$request->productimg3->move(public_path('admin/inventoryImages'), $imageName3);
            if(!$moveProductImg3){
                Log::error('Product Image 3 FAILED for Inventory Addition Request: ',[$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload product image 3 !!');
            }
            Log::info('Product Image 3 added for Inventory Addition Request: ',[$request->except(['_token'])]);
        }

        $getcateAndSubCat=inventory::getcateAndSubCat($request->collection_id);
        $payload=[
            'thumbnailimg'=>$imageName,
            'productimg1'=>$imageName1,
            'productimg2'=>$imageName2,
            'productimg3'=>$imageName3,
            'itemName'=>$request->itemName,
            'strikerPrice'=>$request->strikerPrice,
            'actualPrice'=>$request->actualPrice,
            'offerBadge'=>$request->offerBadge,
            'itemDescription'=>$request->itemDescription,
            'dimensions'=>$request->dimensions,
            'size'=>$request->size,
            'quantity'=>$request->quantity,
            'salePitch'=>$request->salePitch,
            'importantNote'=>$request->importantNote,
            'collection_id'=>$request->collection_id,
            'collection_name'=>$getcateAndSubCat->collection,
            'category_id'=>$getcateAndSubCat->top_parent_id,
            'sub_category_id'=>$getcateAndSubCat->sub_category_id,
            'status'=>1,
        ];
        $insert=inventory::createInventory($payload);
        if($insert){
            Log::info('Inventory creation success for payload: ',[$request->except(['_token'])]);
            return redirect()->back()->with('success', 'New Inventory Item has been created successfully');
        }
        Log::error('Error occured while creating inventory for payload: ',[$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured!! Please contact developer..');
    }
}

