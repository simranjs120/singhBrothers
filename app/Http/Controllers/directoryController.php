<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use App\Models\dashboardModel as dashboard;
use App\Models\directoryModel as directory;
use Illuminate\Support\Facades\Auth;
use App\Models\changesTrackerModel as tracker;

class directoryController extends Controller
{
    public function index()
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['directory'] = directory::fetchDirectory();
        return view('admin.directory', $data);
    }

    public function insertEntryFromAdmin(Request $request)
    {
        try {
            Log::info("Manual entry into directory request by User ID: ", [Auth::id()]);
            $email = $request->email;
            $phone = $request->phone;
            $created_by = Auth::user()->name . ' (' . Auth::user()->email . ')';
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'created_from' => $created_by,
                'created_at' => Helper::timeStamp()
            ];
            $insert = directory::insertDataFromAdmin($data, $email, $phone);
            if ($insert == 1) {
                Log::info('New user created directly to directory, Payload: ', [$request->except(['_token'])]);
                # Entry for changes tracker start
                $data['profile'] = dashboard::fetchProfile();
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " added a new user to directory with email: " . $email;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Enter for changes tracker end
                return redirect()->back()->with('success', 'New directory entry has been created successfully');
            } else if ($insert == 2) {
                Log::info('Error while creating new user created directly to directory');
                return redirect()->back()->with('error', 'Error: Request Rejected, Entry already exists');
            }
        } catch (\Exception $e) {
            Log::error('Exception in submit labels function: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }
    public function deleteItem($id)
    {
        try {
            Log::info('Directory item delete request by user ID: ', [Auth::id()]);
            $previousData = directory::getItemWithId($id);
            $delete = directory::deleteItem($id);
            if ($delete) {
                # Entry for changes tracker start
                $data['profile'] = dashboard::fetchProfile();
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " deleted directory entry with email: " . $previousData->email;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Enter for changes tracker end
                Log::info('Directory item Deleted ID: ', [$id]);
                return redirect()->back()->with('success', 'Directory entry has been deleted successfully');
            }
        } catch (\Exception $e) {
            Log::error('Exception in delete directory item module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function editEntryFromAdmin(Request $request)
    {
        try {
            Log::info('Directory edit request by user ID: ', [Auth::id()]);
            $data = $request->except(['_token', 'id']);
            $id = $request->id;
            $email=$request->email;
            $update = directory::updateEntry($id, $data);
            if ($update) {
                # Entry for changes tracker start
                $data['profile'] = dashboard::fetchProfile();
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " edited directory entry with email: " . $email;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Enter for changes tracker end
                Log::info('Directory item edited ID: ', [$id]);
                return redirect()->back()->with('success', 'Directory entry has been edited successfully');
            }
        } catch (\Exception $e) {
            Log::error('Exception in edit directory item module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }
}
