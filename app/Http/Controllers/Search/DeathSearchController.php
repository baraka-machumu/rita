<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DeathSearchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

     public  function  newBirthCertificateSearch($tab){

//         dd(88);

         $cdata=  DB::table('ServApplicationTracker as sap')
             ->select('*','nro.OfficeName as NearestOffice')
             ->where('sap.ServiceTypeID','=',10)
             ->where('sap.HandlerID','=',null)
             ->where('sap.ApplicationStatusID','=',1)
             ->where('sap.NearestRitaOfficeID','=',Auth::user()->RitaOfficeID)
             ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->get();

         $myTaskcdata=  DB::table('ServApplicationTracker as sap')
             ->select('*','nro.OfficeName as NearestOffice')
             ->where('sap.ServiceTypeID','=',10)
             ->where('sap.HandlerID','=',Auth::user()->StaffID)
             ->where('sap.NearestRitaOfficeID','=',Auth::user()->RitaOfficeID)

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->where('sap.ApplicationStatusID','=',1)
             ->where('sap.NearestRitaOfficeID','=',Auth::user()->RitaOfficeID)
             ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->get();

         $regions  =  HelperController::getRegions();
         $districts =  HelperController::getDistricts();

//         return response()->json($cdata);

         return view('search.tab_death',compact('tab','regions','districts','cdata','myTaskcdata'));

     }

    public  function  process($tab){

//         dd(88);

        $cdata=  DB::table('ServApplicationTracker as sap')
            ->select('*','nro.OfficeName as NearestOffice')
            ->where('sap.ServiceTypeID','=',10)
            ->where('sap.NextToActID','=',null)
            ->where('sap.ApplicationStatusID','=',3)
            ->where('sap.ProcessingOfficeID','=',Auth::user()->RitaOfficeID)
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->get();

        $myTaskcdata=  DB::table('ServApplicationTracker as sap')
            ->select('*','nro.OfficeName as NearestOffice')
            ->where('sap.ServiceTypeID','=',10)
            ->where('sap.NextToActID','=',Auth::user()->StaffID)
            ->where('sap.ProcessingOfficeID','=',Auth::user()->RitaOfficeID)

            ->where('sap.ApplicationStatusID','=',3)
            ->where('sap.NearestRitaOfficeID','=',Auth::user()->RitaOfficeID)
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->get();

        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

        return view('search.tab_death_process',compact('myTaskcdata','tab','regions','districts','cdata'));

    }



    public  function  viewBirthCertificateSearch($trackerId){

         $handlerId  =  Auth::user()->StaffID;

         $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);


         $cdata=   DB::table('ServApplicationTracker as sap')
             ->where('sap.ServiceTypeID','=',10)
             ->where('sap.HandlerID','=',$handlerId)
             ->where('sap.TrackerID','=',$trackerId)

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->first();

//         return response()->json($cdata);

         $is_result = false;

         return view('search.view_new_death_search_service',compact('cdata','is_result'));


     }

     public  function checkExisteByEntryNumber(Request $request,$trackerId){

        $entryNo =  $request->entryNumberSearch;


        if ($entryNo==null){

            Session::flash('alert-warning',' No Entry Number Speficied..');

            return redirect()->back();
        }
         $result =  DB::table('DataInfo')->where('DeathEntryNo',$entryNo)->first();

         $handlerId  =  Auth::user()->StaffID;

         $cdata=   DB::table('ServApplicationTracker as sap')
             ->where('sap.ServiceTypeID','=',10)
             ->where('sap.HandlerID','=',$handlerId)
             ->where('sap.TrackerID','=',$trackerId)

             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->first();

//         return response()->json($cdata);

         $is_result = true;

         return view('search.view_new_death_search_service',compact('cdata','is_result','result'));


     }

     public  function  sendBackResult(Request $request){


         $trackerId  =  $request->trackerId;
         $searchId =  $request->searchId;
         $comment  =  $request->comment;

         $handlerId  =  Auth::user()->StaffID;

         DB::table('BirthSearch')->where('SearchID',$searchId)->update(['Comment'=>$comment]);

         $status =  8;
         DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

         CommentController::commentSave($request,$handlerId,$trackerId,"Searching");

         Session::flash('alert-success',' Feedback Sent..');

         return redirect('death-certificates/search');

     }

}
