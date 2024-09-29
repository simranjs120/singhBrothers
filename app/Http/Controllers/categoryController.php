<?php

namespace App\Http\Controllers;

use App\Models\dashboardModel as dashboard;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class categoryController extends Controller
{
    public function index(Request $request)
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['categoryData'] = category::fetchCategories();
        $data['allCategoryData'] = category::fetchAllCategoryData();
        $data['subCategoryData'] = category::fetchSubCategories();
        return view('admin.category', $data);
    }

    public function getCollections($id)
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['collectionData'] = category::collectionData($id);
        return view('admin.collections', $data);
    }

    public function create(Request $request)
    {
        try {
            Log::info('New Category Addition Request By User ID: ', [Auth::id()]);
            $data['profile'] = dashboard::fetchProfile();
            $payload = $request->category;
            Log::info('New Category Addition Request By: ', [$data['profile']->name]);
            Log::info('Category Name: ', [$payload]);
            $insertCategory = category::insertCategory($payload, $parent_id = 0);
            if ($insertCategory == 1) {
                Log::info('Category Inserted Successfully', [$payload]);
                # Entry for changes tracker
                $categoryName = $payload;
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " added a new category: " . $categoryName;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                return redirect()->back()->with('success', 'New category has been added to the system successfully !!');
            } else if ($insertCategory == 2) {
                Log::error('Category Insertion failed, Record already exists', [$payload]);
                return redirect()->back()->with('error', 'Request Rejected, This category already exists in the system !!');
            } else if ($insertCategory == 0) {
                Log::error('Category Insertion failed', [$payload]);
                return redirect()->back()->with('error', 'An error occured !! Please try again !!');
            }
        } catch (\Exception $e) {
            Log::error('Exception in category module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function changeStatus($id, $status)
    {
        try {
            Log::info('Category module change status request by User ID: ', [Auth::id()]);
            $data['profile'] = dashboard::fetchProfile();
            $fetchCategoryName = category::getCategoryName($id);
            $categoryName = $fetchCategoryName->category;
            Log::info('Category Status change request for category ID,Status,Name: ', [$id, $status, $categoryName]);
            $changestatus = category::changeStatus($id, $status);
            if ($changestatus) {
                # Entry for changes tracker
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                if ($status == 0) {
                    $changer_title = " changed the status to In-Active for category Name: " . $categoryName;
                } else if ($status == 1) {
                    $changer_title = " changed the status to Active for category Name: " . $categoryName;
                }
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                Log::info('Status change successfull for category ID: ', [$id]);
                return redirect()->back()->with('success', 'Status Changed Successfully !!');
            } else {
                Log::error('Status change failed for category ID: ', [$id]);
                return redirect()->back()->with('error', 'An error occured !! Please try again !!');
            }
        } catch (\Exception $e) {
            Log::error('Exception in category change status module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function deleteCategory($id)
    {
        try {
            Log::info('Delete category request by User ID: ', [Auth::id()]);
            $data['profile'] = dashboard::fetchProfile();
            $fetchCategoryName = category::getCategoryName($id);
            $categoryName = $fetchCategoryName->category;
            Log::info('Category Deletion request for category ID,Name: ', [$id, $categoryName]);
            # Delete from collection also.
            $checkIfTopParent = category::checkIfTopParent($id);
            if ($checkIfTopParent == "top") {
                $delete = category::deleteFromCollectionTopParent($id);
                Log::info('Deleted from collection Top Parent');
            } else {
                $delete = category::deleteFromCollectionChildParent($id);
                Log::info('Deleted from collection Child Parent');
            }
            $changestatus = category::deleteCategory($id);

            if ($changestatus == 1) {
                # Entry for changes tracker
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " deleted a category: " . $categoryName;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                Log::info('Deletion successfull for category ID: ', [$id]);
                return redirect()->back()->with('success', 'Category Deleted Successfully !!');
            } else if ($changestatus == 2) {
                Log::error('Deletion failed for category because sub-category exists, Category ID: ', [$id]);
                return redirect()->back()->with('error', 'A sub-category exists for this category, Please delete sub-categories first !!');
            } else if ($changestatus == 0) {
                Log::error('Deletion failed for category ID: ', [$id]);
                return redirect()->back()->with('error', 'An error occured !! Please try again !!');
            }
        } catch (\Exception $e) {
            Log::error('Exception in category delete module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function submitSubCategories(Request $request)
    {
        try {
            $data['profile'] = dashboard::fetchProfile();
            // $data = $request->except(['_token']);
            $data = [
                'parent_id' => $request->parent_id,
                'category' => $request->category,
                'created_at' => Helper::timeStamp()
            ];
            $action = category::submitSubCategories($data);
            if ($action) {
                $lastInsertedId = category::getLastInsertedCategoryId();

                # Creating collection
                $parent_id = $request->parent_id;
                $category = $request->category;
                $checkIfTopParent = category::checkIfTopParent($parent_id);

                if ($checkIfTopParent == "top") {
                    $getSubcategoryById = category::getSubcategoryById($parent_id);
                    $breadcrumb = $getSubcategoryById->category . '/' . $category;
                    $createNewCollection = category::createNewCollectionTopParent($parent_id, $breadcrumb, $lastInsertedId->id);
                } else {
                    $getSubcategoryById = category::getSubcategoryById($parent_id);
                    $breadcrumb = $category;
                    $createNewCollection = category::createNewCollectionChildParent($parent_id, $breadcrumb, $checkIfTopParent, $lastInsertedId->id);
                }
                Log::info('Added to collection table', [$data]);

                $data['profile'] = dashboard::fetchProfile();
                Log::info('sub-Category Inserted Successfully', [$data]);
                # Entry for changes tracker
                $categoryName = $data['category'];
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " added a new Sub-category: " . $categoryName;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Tracker End
                return redirect()->back()->with('success', 'New Sub-category has been added to the system successfully !!');
            }
            Log::error('Sub-category Insertion failed, Payload data: ', [$data]);
            return redirect()->back()->with('error', 'An error occured !! Please try again !!');
        } catch (\Exception $e) {
            Log::error('Exception in subcategory module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }
}
