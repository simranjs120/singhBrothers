<?php

namespace App\Http\Controllers;
use App\Models\queryModel as query;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use App\Models\dashboardModel as dashboard;
use App\Models\directoryModel as directory;
use App\Models\changesTrackerModel as tracker;

use Illuminate\Http\Request;

class queryController extends Controller
{
    public function index()
    {
        $data['profile'] = dashboard::fetchProfile();
        $data['product'] = query::fetchQueries('product');
        $data['contact'] = query::fetchQueries('contact');
        return view('admin.query', $data);
    }

    public function submit(Request $request)
    {
        try {
            $data = [
                'product' => $request->product,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'type'=>'product',
                'created_at'=>Helper::timeStamp()
            ];

            $dataDirectory = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'created_from'=>'Product Query',
                'created_at'=>Helper::timeStamp()
            ];
            $insertInQuery = query::insert($data);
            $insertInDirectory=directory::insert($dataDirectory,$request->email,$request->phone);
            if ($insertInQuery && $insertInDirectory) {
                return redirect()->back()->with('success', 'Query has been sent successfully, We`ll respond as soon as we can');
            }
            
        } catch (\Exception $e) {
            Log::error('Exception in submitting query by customer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function submitContact(Request $request){
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'type'=>'contact',
                'created_at'=>Helper::timeStamp()
            ];

            $dataDirectory = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'created_from'=>'Contact Form',
                'created_at'=>Helper::timeStamp()
            ];
            $insertInQuery = query::insert($data);
            $insertInDirectory=directory::insert($dataDirectory,$request->email,$request->phone);
            if ($insertInQuery && $insertInDirectory) {
                return redirect()->back()->with('success', 'Query has been sent successfully, We`ll respond as soon as we can');
            }
            
        } catch (\Exception $e) {
            Log::error('Exception in submitting query by customer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }

    public function deleteItem($id){
        try {
            Log::info('Query item delete request by user ID: ', [Auth::id()]);
            $previousData = query::getItemWithId($id);
            $delete = query::deleteItem($id);
            if ($delete) {
                # Entry for changes tracker start
                $data['profile'] = dashboard::fetchProfile();
                $changer_name = $data['profile']->name;
                $changer_email = $data['profile']->email;
                $changer_title = " deleted query entry with email: " . $previousData->email;
                $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
                if ($trackIt) {
                    Log::info('Addition to tracker table success');
                } else {
                    Log::error('Addition to tracker table failed');
                }
                # Enter for changes tracker end
                Log::info('Query item Deleted ID: ', [$id]);
                return redirect()->back()->with('success', 'Query entry has been deleted successfully');
            }
        } catch (\Exception $e) {
            Log::error('Exception in delete query item module: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!! Please try again !');
        }
    }
}
