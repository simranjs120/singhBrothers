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
use Illuminate\Support\Facades\Auth;


class inventoryController extends Controller
{
    public function index(Request $request)
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['inventory'] = inventory::getInventory();
        $data['labels'] = labels::fetchLabels();
        return view('admin.inventory', $data);
    }

    public function addInventory()
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['collections'] = inventory::getCollections();
        return view('admin.addInventory', $data);
    }

    public function editInventory($id)
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['collections'] = inventory::getCollections();
        $data['inventoryData'] = inventory::getInventoryWithId($id);
        $data['inventoryId'] = $id;
        return view('admin.editInventory', $data);
    }

    public function submitInventoryChanges(Request $request)
    {
        try {
            $request->validate([
                'thumbnailimg' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
                'productimg1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
                'productimg2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
                'productimg3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
            ]);
            Log::info('Inventory edit request by User ID: ', [Auth::id()]);
            Log::info('Inventory edit Request: ', [$request->except(['_token', 'thumbnailimg', 'productimg1', 'productimg2', 'productimg3'])]);

            $previousData = inventory::getInventoryWithId($request->id);

            $imageName = $this->uploadInventoryImage($request, 'thumbnailimg', 'thumbnail-img', $previousData->thumbnailimg);
            $imageName1 = $this->uploadInventoryImage($request, 'productimg1', 'product-img-1', $previousData->productimg1);
            $imageName2 = $this->uploadInventoryImage($request, 'productimg2', 'product-img-2', $previousData->productimg2);
            $imageName3 = $this->uploadInventoryImage($request, 'productimg3', 'product-img-3', $previousData->productimg3);


            $getcateAndSubCat = inventory::getcateAndSubCat($request->collection_id);
            $payload = [
                'thumbnailimg' => $imageName,
                'productimg1' => $imageName1,
                'productimg2' => $imageName2,
                'productimg3' => $imageName3,
                'itemName' => $request->itemName,
                'strikerPrice' => $request->strikerPrice,
                'actualPrice' => $request->actualPrice,
                'offerBadge' => $request->offerBadge,
                'itemDescription' => $request->itemDescription,
                'dimensions' => $request->dimensions,
                'size' => $request->size,
                'quantity' => $request->quantity,
                'salePitch' => $request->salePitch,
                'importantNote' => $request->importantNote,
                'collection_id' => $request->collection_id,
                'collection_name' => $getcateAndSubCat->collection,
                'category_id' => $getcateAndSubCat->top_parent_id,
                'sub_category_id' => $getcateAndSubCat->sub_category_id,
                'status' => $previousData->status,
            ];
            $update = inventory::updateInventory($request->id, $payload);
            if ($update) {
                Log::info('Inventory updation success for payload: ', [$request->except(['_token'])]);
                # Entry for changes tracker
                $data['profile'] = dashboard::fetchProfile();
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " updated inventory item named as: " . $request->itemName;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }

                return redirect()->back()->with('success', 'Inventory Item has been updated successfully');
            }
            Log::error('Error occured while updating inventory for payload: ', [$request->except(['_token'])]);
            return redirect()->back()->with('error', 'An error occured !! Please try again !!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Exception in submit inventory changes function: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }

    }

    public function submitInventory(Request $request)
    {
        try {
            $request->validate([
                'thumbnailimg' => 'required|image|mimes:jpg,jpeg,png,webp|max:6144',
                'productimg1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
                'productimg2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
                'productimg3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6144',
            ]);
            Log::info('Inventory submit request by User ID: ', [Auth::id()]);
            Log::info('New Inventory Addition Request: ', [$request->except(['_token', 'thumbnailimg', 'productimg1', 'productimg2', 'productimg3'])]);

            $imageName = $this->uploadInventoryImage($request, 'thumbnailimg', 'thumbnail-img');
            $imageName1 = $this->uploadInventoryImage($request, 'productimg1', 'product-img-1');
            $imageName2 = $this->uploadInventoryImage($request, 'productimg2', 'product-img-2');
            $imageName3 = $this->uploadInventoryImage($request, 'productimg3', 'product-img-3');

            $getcateAndSubCat = inventory::getcateAndSubCat($request->collection_id);
            $payload = [
                'thumbnailimg' => $imageName,
                'productimg1' => $imageName1,
                'productimg2' => $imageName2,
                'productimg3' => $imageName3,
                'itemName' => $request->itemName,
                'strikerPrice' => $request->strikerPrice,
                'actualPrice' => $request->actualPrice,
                'offerBadge' => $request->offerBadge,
                'itemDescription' => $request->itemDescription,
                'dimensions' => $request->dimensions,
                'size' => $request->size,
                'quantity' => $request->quantity,
                'salePitch' => $request->salePitch,
                'importantNote' => $request->importantNote,
                'collection_id' => $request->collection_id,
                'collection_name' => $getcateAndSubCat->collection,
                'category_id' => $getcateAndSubCat->top_parent_id,
                'sub_category_id' => $getcateAndSubCat->sub_category_id,
                'status' => 1,
                'created_at' => Helper::timeStamp()
            ];
            $insert = inventory::createInventory($payload);
            if ($insert) {
                Log::info('Inventory creation success for payload: ', [$request->except(['_token'])]);
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
            Log::error('Error occured while creating inventory for payload: ', [$request->except(['_token'])]);
            return redirect()->back()->with('error', 'An error occured !! Please try again !!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Exception in submit inventory function: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    private function uploadInventoryImage(Request $request, string $field, string $prefix, string $previousImage = ""): string
    {
        if (!$request->hasFile($field)) {
            return $previousImage;
        }

        $imageName = $prefix . '-' . uniqid() . '.' . $request->file($field)->extension();
        $request->file($field)->move(public_path('admin/inventoryImages'), $imageName);

        if ($previousImage !== "") {
            File::delete(public_path('admin/inventoryImages/') . $previousImage);
        }

        return $imageName;
    }

    public function changeInventoryStatus($status, $id)
    {
        try {
            $updateStatus = inventory::changeInventoryStatus($status, $id);
            $previousData = inventory::getInventoryWithId($id);
            if ($updateStatus) {
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
                Log::info('Status update for inventory ID: ', [$id]);
                return redirect()->back()->with('success', 'Inventory Item status has been updated successfully');
            }
            Log::error('Error occured while updating status for inventory ID: ', [$id]);
            return redirect()->back()->with('error', 'An error occured !! Please try again !!');
        } catch (\Exception $e) {
            Log::error('Exception in inventory change status module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function deleteInventory($id)
    {
        try {
            Log::info("Inventory Deletion request for Inventory ID: ", [$id]);

            $previousData = inventory::getInventoryWithId($id);
            $thumbNailImg = File::delete(public_path('admin/inventoryImages/') . $previousData->thumbnailimg);
            $productimg1 = File::delete(public_path('admin/inventoryImages/') . $previousData->productimg1);
            $productimg2 = File::delete(public_path('admin/inventoryImages/') . $previousData->productimg2);
            $productimg3 = File::delete(public_path('admin/inventoryImages/') . $previousData->productimg3);
            $delete = inventory::deleteInventory($id);

            if ($delete) {
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
                Log::info('Delete Request for inventory ID: ', [$id]);
                return redirect()->back()->with('success', 'Inventory Item has been deleted successfully');
            }
            Log::error('Error occured while deleting for inventory ID: ', [$id]);
            return redirect()->back()->with('error', 'An error occured !! Please try again !!');
        } catch (\Exception $e) {
            Log::error('Exception in delete inventory module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function viewInventory($id)
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['inventory'] = inventory::getInventoryWithId($id);
        $data['inventoryId'] = $id;
        return view('admin.viewInventory', $data);
    }
}
