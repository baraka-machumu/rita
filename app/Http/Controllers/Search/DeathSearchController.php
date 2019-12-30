<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
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

     public  function  newBirthCertificateSearch(){

//         dd(88);

         $cdata=  DB::table('ServApplicationTracker as sap')
             ->where('sap.ServiceTypeID','=',10)
             ->where('sap.HandlerID','=',null)
             ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
             ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
             ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->get();


         return view('search.new_death_search_service_list',compact('cdata'));

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


     public  function checkExisteByEntryNumber(Request $request){

        $entryNo =  $request->entryNumberSearch;


         $result =  DB::table('DataInfo')->where('EntryNo',$entryNo)->first();

         $handlerId  =  Auth::user()->StaffID;

         $cdata=   DB::table('ServApplicationTracker as sap')
             ->where('sap.ServiceTypeID','=',10)
             ->where('sap.HandlerID','=',$handlerId)
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
