<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BirthSearchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

     public  function  newBirthCertificateSearch($tab){


         $cdata=  DB::table('ServApplicationTracker as sap')
             ->select('*','nro.OfficeName as NearestOffice')
             ->where('sap.ServiceTypeID','=',5)
             ->where('sap.HandlerID','=',null)
             ->where('sap.ApplicationStatusID','=',1)
             ->where('sap.NearestRitaOfficeID','=',Auth::user()->RitaOfficeID)

             ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->get();

         $myTaskcdata=  DB::table('ServApplicationTracker as sap')
             ->select('*','nro.OfficeName as NearestOffice')
             ->where('sap.ServiceTypeID','=',5)
             ->where('sap.HandlerID','=',Auth::user()->StaffID)
             ->where('sap.NearestRitaOfficeID','=',Auth::user()->RitaOfficeID)
             ->where('sap.ApplicationStatusID','=',1)
             ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->get();

         $regions  =  HelperController::getRegions();
         $districts =  HelperController::getDistricts();

         return view('search.tab_birth',compact('tab','myTaskcdata','regions','districts','cdata'));

     }

    public  function  processing($tab){


        $cdata=  DB::table('ServApplicationTracker as sap')
            ->select('*','nro.OfficeName as NearestOffice')
            ->where('sap.ServiceTypeID','=',5)
            ->where('sap.NextToActID','=',null)
            ->where('sap.ApplicationStatusID','=',3)
            ->where('sap.ProcessingOfficeID','=',Auth::user()->RitaOfficeID)

            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->get();

        $myTaskcdata=  DB::table('ServApplicationTracker as sap')
            ->select('*','nro.OfficeName as NearestOffice')
            ->where('sap.ServiceTypeID','=',5)
            ->where('sap.NextToActID','=',Auth::user()->StaffID)
            ->where('sap.ProcessingOfficeID','=',Auth::user()->RitaOfficeID)
            ->where('sap.ApplicationStatusID','=',3)
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->get();

//        return response()->json($myTaskcdata);
        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

        return view('search.tab_birth_process',compact('tab','myTaskcdata','regions','districts','cdata'));

    }

     public  function  viewBirthCertificateSearch($trackerId){


         $handlerId  =  Auth::user()->StaffID;

         $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

         $cdata=   DB::table('ServApplicationTracker as sap')
             ->where('sap.ServiceTypeID','=',5)
             ->where('sap.HandlerID','=',$handlerId)
             ->where('sap.TrackerID','=',$trackerId)

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->first();

//         return response()->json($cdata);

         $is_result = false;
         $processing  =  true;
         $verify =  true;
         return view('search.view_new_birth_search_service',compact('processing','verify','cdata','is_result'));

     }


     public  function  viewProcess($trackerId){

         $handlerId  =  Auth::user()->StaffID;

         $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

         $cdata=   DB::table('ServApplicationTracker as sap')
             ->where('sap.ServiceTypeID','=',5)
             ->where('sap.HandlerID','=',$handlerId)
             ->where('sap.TrackerID','=',$trackerId)

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->first();

//         return response()->json($cdata);
         $is_result = false;
         $processing  =  true;
         $verify =  false;

         return view('search.view_new_birth_search_service',compact('processing','verify','cdata','is_result'));

     }
    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        Session::flash('alert-success','Task Taken');

        return redirect('birth-certificates/search/'.$tab.'/request');

    }

    public  function  processMyTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['NextToActID'=>$handlerId]);

        $tab  =  2;

        Session::flash('alert-success','Task Taken');

        return redirect('birth-certificates/search/'.$tab.'/processing');

    }
     public  function checkExisteByEntryNumber(Request $request,$trackerId){

        $entryNo =  $request->entryNumberSearch;

         if ($entryNo==null){

             Session::flash('alert-warning',' No Entry Number Speficied..');

             return redirect()->back();
         }
         $result =  DB::table('DataInfo')->where('EntryNo',$entryNo)->first();
         $handlerId  =  Auth::user()->StaffID;


         $cdata=   DB::table('ServApplicationTracker as sap')
             ->where('sap.ServiceTypeID','=',5)
             ->where('sap.HandlerID','=',$handlerId)
             ->where('sap.TrackerID','=',$trackerId)

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->first();

//         return response()->json($cdata);

         $is_result = true;

         return view('search.view_new_birth_search_service',compact('cdata','is_result','result'));

     }


    public  function processCheckExisteByEntryNumber(Request $request,$trackerId){

        $entryNo =  $request->entryNumberSearch;

        if ($entryNo==null){

            Session::flash('alert-warning',' No Entry Number Speficied..');

            return redirect()->back();
        }
        $result =  DB::table('DataInfo')->where('EntryNo',$entryNo)->first();
        $handlerId  =  Auth::user()->StaffID;


        $cdata=   DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',5)
            ->where('sap.NextToActID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->first();

//         return response()->json($cdata);

        $is_result = true;
        $processing =  true;

        return view('search.view_new_birth_search_service',compact('processing','cdata','is_result','result'));

    }

    public  function  sendBackResult(Request $request){


         $trackerId  =  $request->trackerId;
         $searchId =  $request->searchId;
         $comment  =  $request->comment;

         $handlerId  =  Auth::user()->StaffID;

         DB::table('BirthSearch')->where('SearchID',$searchId)->update(['Comment'=>$comment]);

         $status =  3;
         DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

         CommentController::commentSave($request,$handlerId,$trackerId,"Searching",'BirthSearch','SearchID');

         Session::flash('alert-success','Verified');

         return redirect('birth-certificates/search/2/request');

     }


    public  function  approve(Request $request){


        $trackerId  =  $request->trackerId;
        $searchId =  $request->searchId;
        $comment  =  $request->comment;

        $handlerId  =  Auth::user()->StaffID;

        DB::table('BirthSearch')->where('SearchID',$searchId)->update(['Comment'=>$comment]);

        $status =  10;
        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        CommentController::commentSave($request,$handlerId,$trackerId,"Searching",'BirthSearch','SearchID');

        Session::flash('alert-success','Approved');

        return redirect('birth-certificates/search/2/processing');

    }

}
