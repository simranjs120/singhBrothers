<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dashboardModel as dashboard;
use App\Models\inventoryModel as inventory;
use App\Models\landingSectionModel as landingSection;
use App\Models\changesTrackerModel as tracker;
use App\Models\categoryModel as category;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class landingSectionController extends Controller
{
    public function index(){
        $data['profile'] = dashboard::fetchProfile();
        $data['navTabs']=landingSection::getNavTabs();
        $data['headings']=landingSection::getHeadings();
        return view('admin.landingSection',$data);
    }

    public function configureNavTab(Request $request){
        Log::info('New tab configuration request: ',[$request->tabName]);
        $number=$request->tabNumber;
        $configuration=NULL;
        if($number==1){
            $tabName=$request->tabName;
            $tabLink=$request->tabLink;
            $configuration=landingSection::configureNavTab(1,$tabName,$tabLink);
        }
        if($number==2){
            $tabName=$request->tabName;
            $tabLink=$request->tabLink;
            $configuration=landingSection::configureNavTab(2,$tabName,$tabLink);
        }
        if($number==3){
            $tabName=$request->tabName;
            $tabLink=$request->tabLink;
            $configuration=landingSection::configureNavTab(3,$tabName,$tabLink);
        }
        if($number==4){
            $tabName=$request->tabName;
            $tabLink=$request->tabLink;
            $configuration=landingSection::configureNavTab(4,$tabName,$tabLink);
        }
        if($number==5){
            $tabName=$request->tabName;
            $tabLink=$request->tabLink;
            $configuration=landingSection::configureNavTab(5,$tabName,$tabLink);
        }
        if($number==6){
            $tabName=$request->tabName;
            $tabLink=$request->tabLink;
            $configuration=landingSection::configureNavTab(6,$tabName,$tabLink);
        }

        if($configuration){
            # Entry for changes tracker
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " just configured a new navbar item: " . $request->tabName;
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Tracker end
            Log::info('New tab configuration request successfull: ',[$request->tabName]);
            return redirect()->back()->with('success', 'New tab configuration updated successfully');
        }
        Log::error('New tab configuration request FAILED: ',[$request->tabName]);
        return redirect()->back()->with('error', 'An Error Occurred !! Please try again !!');
    }

    public function configureLandingHeadings(Request $request){
        $title=$request->title;
        $titleColor=$request->titleColor;
        $tagline=$request->tagline;
        $search_line=$request->search_line;
        Log::info('Heading configuration request title/tagline/search_line: ',[$title,$tagline,$search_line]);
        $update=landingSection::configureLandingHeadings($title,$titleColor,$tagline,$search_line);
        if($update){
            # Entry for changes tracker
            $data['profile'] = dashboard::fetchProfile();
            $changer_name = $data['profile']->name;
            $changer_email = $data['profile']->email;
            $changer_title = " changed headings";
            $trackIt = tracker::insert($changer_title, $changer_email, $changer_name);
            if ($trackIt) {
                Log::info('Addition to tracker table success');
            } else {
                Log::error('Addition to tracker table failed');
            }
            # Tracker end
            Log::info('New headings configuration request successfull');
            return redirect()->back()->with('success', 'New headings configured successfully');
        }
        Log::error('New headings configuration request FAILED');
        return redirect()->back()->with('error', 'An Error Occurred !! Please try again !!');
    }
}
