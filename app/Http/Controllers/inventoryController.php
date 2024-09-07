<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dashboardModel as dashboard;
use App\Models\inventoryModel as inventory;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Models\labelsModel as labels;


class inventoryController extends Controller
{
    public function index(Request $request){
        $data['profile'] = dashboard::fetchProfile();
        $data['inventory']=inventory::getInventory();
        $data['labels']=labels::fetchLabels();
        return view('admin.inventory',$data);
    }

    public function addInventory(){
        $data['profile'] = dashboard::fetchProfile();
        $data['collections']=inventory::getCollections();
        return view('admin.addInventory',$data);
    }

    public function editInventory($id){
        $data['profile'] = dashboard::fetchProfile();
        $data['collections']=inventory::getCollections();
        $data['inventoryData']=inventory::getInventoryWithId($id);
        $data['inventoryId']=$id;
        return view('admin.editInventory',$data);
    }

    public function submitInventoryChanges(Request $request){
        $imageName="";
        $imageName1="";
        $imageName2="";
        $imageName3="";
        Log::info('Inventory edit Request: ',[$request->except(['_token'])]);

        $previousData=inventory::getInventoryWithId($request->id);

        # Check if images are also changed, If yes, Delete the previous images first to avoid redundant data.
        if($request->thumbnailimg!=""){
            # Delete the previous image
            File::delete(public_path('admin/inventoryImages/') . $previousData->thumbnailimg);
            # Thumbnail Image 
            $thumbnailImageName = "thumbnail-img-" . time();
            $imageName = $thumbnailImageName . '.' . $request->thumbnailimg->extension();
            $moveThumbnailImg=$request->thumbnailimg->move(public_path('admin/inventoryImages'), $imageName);
            if(!$moveThumbnailImg){
                Log::error('Thumbnail EDIT ADDITION FAILED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload thumbnail image !!');
            }
            Log::info('Thumbnail EDIT ADDED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
        } 
        # If user has not edited any images, so that values should be the same as the previous ones, Setting default value before insert action.
        else {
            $imageName=$previousData->thumbnailimg;
        }

        if($request->productimg1!=""){
            # Delete the previous image
            File::delete(public_path('admin/inventoryImages/') . $previousData->productimg1);
            # Product Image 1
            $productImage1 = "product-img-1-" . time();
            $imageName1 = $productImage1 . '.' . $request->productimg1->extension();
            $moveProductImg1=$request->productimg1->move(public_path('admin/inventoryImages'), $imageName1);
            if(!$moveProductImg1){
                Log::error('Product Image 1 FAILED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload product image 1 !!');
            }
            Log::info('Product Image 1 EDIT ADDED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
        }
        # If user has not edited any images, so that values should be the same as the previous ones, Setting default value before insert action.
        else {
            $imageName1=$previousData->productimg1;
        }

        if($request->productimg2!=""){
            # Delete the previous image
            File::delete(public_path('admin/inventoryImages/') . $previousData->productimg2);
            # Product Image 2
            $productImage2 = "product-img-2-" . time();
            $imageName2 = $productImage2 . '.' . $request->productimg2->extension();
            $moveProductImg2=$request->productimg2->move(public_path('admin/inventoryImages'), $imageName2);
            if(!$moveProductImg2){
                Log::error('Product Image 2 FAILED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload product image 2 !!');
            }
            Log::info('Product Image 2 EDIT ADDED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
        }
        # If user has not edited any images, so that values should be the same as the previous ones, Setting default value before insert action.
        else {
            $imageName2=$previousData->productimg2;
        }

        if($request->productimg3!=""){
            # Delete the previous image
            File::delete(public_path('admin/inventoryImages/') . $previousData->productimg3);
            # Product Image 3
            $productImage3 = "product-img-3-" . time();
            $imageName3 = $productImage3 . '.' . $request->productimg3->extension();
            $moveProductImg3=$request->productimg3->move(public_path('admin/inventoryImages'), $imageName3);
            if(!$moveProductImg3){
                Log::error('Product Image 3 FAILED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
                return redirect()->back()->with('error', 'Error: Request Rejected, Could not upload product image 3 !!');
            }
            Log::info('Product Image 3 EDIT ADDED for Inventory EDIT ADDITION Request: ',[$request->except(['_token'])]);
        }
        # If user has not edited any images, so that values should be the same as the previous ones, Setting default value before insert action.
        else {
            $imageName3=$previousData->productimg3;
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
            'status'=>$previousData->status,
        ];
        $update=inventory::updateInventory($request->id,$payload);
        if($update){
            Log::info('Inventory updation success for payload: ',[$request->except(['_token'])]);
            # Entry for changes tracker
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " just updated inventory item named as: " . $request->itemName;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }

            return redirect()->back()->with('success', 'Inventory Item has been updated successfully');
        }
        Log::error('Error occured while updating inventory for payload: ',[$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');

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
            'created_at'=>Helper::timeStamp()
        ];
        $insert=inventory::createInventory($payload);
        if($insert){
            Log::info('Inventory creation success for payload: ',[$request->except(['_token'])]);
            # Entry for changes tracker start
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " just added a new inventory item named as: " . $request->itemName;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Enter for changes tracker end
            return redirect()->back()->with('success', 'New Inventory Item has been created successfully');
        }
        Log::error('Error occured while creating inventory for payload: ',[$request->except(['_token'])]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function changeInventoryStatus($status,$id){
        $updateStatus=inventory::changeInventoryStatus($status,$id);
        $previousData=inventory::getInventoryWithId($id);
        if($updateStatus){
             # Entry for changes tracker start
             $data['profile'] = dashboard::fetchProfile();
             $changer_name = $data['profile']->name;
             $changer_email = $data['profile']->email;
             if ($status == 0) {
                 $changer_title = " changed the status to In-Active for Inventory ID/Name: " . $id . '/' . $previousData->itemName;
             } else if ($status == 1) {
                 $changer_title = " changed the status to Active for category ID/Name: " . $id . '/' . $previousData->itemName;
             }
             $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
             if ($trackIt) {
                 Log::info('Addition to tracker table success');
             } else {
                 Log::error('Addition to tracker table failed');
             }
             # Enter for changes tracker end
            Log::info('Status update for inventory ID: ',[$id]);
            return redirect()->back()->with('success', 'Inventory Item status has been updated successfully');
        }
        Log::error('Error occured while updating status for inventory ID: ',[$id]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function deleteInventory($id){
        Log::info("Inventory Deletion request for Inventory ID: ",[$id]);

        $previousData=inventory::getInventoryWithId($id);
        $thumbNailImg=File::delete(public_path('admin/inventoryImages/') . $previousData->thumbnailimg);
        $productimg1=File::delete(public_path('admin/inventoryImages/') . $previousData->productimg1);
        $productimg2=File::delete(public_path('admin/inventoryImages/') . $previousData->productimg2);
        $productimg3=File::delete(public_path('admin/inventoryImages/') . $previousData->productimg3);
        $delete=inventory::deleteInventory($id);

        if($delete){
             # Entry for changes tracker
             $data['profile'] = dashboard::fetchProfile();
             $changer_name = $data['profile']->name;
             $changer_email = $data['profile']->email;
             $changer_title = " deleted an Inventory item ID/Name: " . $id . '/' . $previousData->itemName;
             $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
             if ($trackIt) {
                 Log::info('Addition to tracker table success');
             } else {
                 Log::error('Addition to tracker table failed');
             }
             # Tracker End
            Log::info('Delete Request for inventory ID: ',[$id]);
            return redirect()->back()->with('success', 'Inventory Item has been deleted successfully');
        }
        Log::error('Error occured while deleting for inventory ID: ',[$id]);
        return redirect()->back()->with('error', 'An error occured !! Please try again !!');
    }

    public function viewInventory($id){
        $data['profile'] = dashboard::fetchProfile();
        $data['inventory']=inventory::getInventoryWithId($id);
        $data['inventoryId']=$id;
        return view('admin.viewInventory',$data);
    }
}

