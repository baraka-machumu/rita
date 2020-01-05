<?php

namespace App\Http\Controllers\BirthRegistration;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BirthVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // function  to view all verification requests
    public  function index($tab) {

        $verifications=  DB::table('ServApplicationTracker as sap')
            ->select('*','nro.OfficeName as NearestOffice')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.HandlerID','=',null)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.NearestRitaOfficeID',Auth::user()->RitaOfficeID)
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();

        if (Auth::user()->IsHQ==1) {

            $verifications=  DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',6)
                ->where('sap.HandlerID','=',null)
//                ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
                ->where('sap.ApplicationStatusID','=',1)
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();

        }
        $myTaskverifications=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.NearestRitaOfficeID',Auth::user()->RitaOfficeID)

            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();
        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

//        return response()->json($verifications);
        return view('births.verify_certificate.tab_verify',compact('regions','districts','tab','myTaskverifications','verifications'));

    }


    // function  to view all verification process
    public  function process($tab) {

        $verifications=  DB::table('ServApplicationTracker as sap')
            ->select('*','nro.OfficeName as NearestOffice')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.NextToActID','=',null)
            ->where('sap.ApplicationStatusID','=',3)

            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();

        if (Auth::user()->IsHQ==1) {

            $verifications=  DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',6)
                ->where('sap.HandlerID','=',null)
//                ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
                ->where('sap.ApplicationStatusID','=',3)

                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();

        }
        $myTaskverifications=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
            ->where('sap.NextToActID','=',Auth::user()->StaffID)
            ->where('sap.ApplicationStatusID','=',3)

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();
        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

//        return response()->json($verifications);
        return view('births.verify_certificate.tab_verify_process',compact('regions','districts','tab','myTaskverifications','verifications'));

    }


    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        Session::flash('alert-success','Task Taken');

        return redirect('birth-certificates/'.$tab.'/verify');

    }

    //function to view verification data

    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $is_result =  false;
        $processing  = false;
        //vdata means verification data

        $vdata=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->first();

//                return response()->json($vdata);

        return view('births.verify_certificate.view_verify_data',compact('processing','vdata','is_result'));

    }


    public  function viewProcessingRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $is_result =  false;
        $processing  = false;

        //vdata means verification data

        $vdata=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.NextToActID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->first();

//                return response()->json($vdata);

        return view('births.verify_certificate.view_verify_data',compact('processing','vdata','is_result'));

    }

    public function serachByEntryNumber(Request $request,$trackerId){

        $entryNo =$request->entryNo; //'192005962068';

        if (empty($entryNo)){

            Session::flash('alert-warning','The Entry Number Is Not Available, Use Manual Process.');

            return  redirect()->back();
        }

        if (!ctype_digit($entryNo)){

            Session::flash('alert-danger','The Entry Number Is Not Valid Number.');

            return  redirect()->back();
        }

//        $result = DB::select('EXEC  Get_InfoDataByEntryNo_SP ?',array($entryNo));

        $handlerId  =  Auth::user()->StaffID;

        $vdata=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('EntryNo','=',$entryNo)->first();

        $is_result =  true;
        $processing  = true;


        return view('births.verify_certificate.view_verify_data',compact('processing','vdata','result','is_result'));

    }

    public  function  response(Request $request){

        $trackerId  =  $request->trackerId;
        $searchId =  $request->verificationId;


        CommentController::commentSave($request,Auth::user()->StaffID,$trackerId,"Verification Service",'BirthVerification','VerificationID');
        $status =  3;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        Session::flash('alert-success','Verified');

        return redirect('birth-certificates/2/verify');

    }

    public  function  approve(Request $request){

        $trackerId  =  $request->trackerId;
        $searchId =  $request->verificationId;

        CommentController::commentSave($request,Auth::user()->StaffID,$trackerId,"Verification Service",'BirthVerification','VerificationID');
        $status =  10;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        Session::flash('alert-success','Approved And Verified');

        return redirect('birth-certificates/verify/2/processing');

    }

    public  function processMyTask($trackerId){


        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['NextToActID'=>$handlerId]);

        $tab  =  2;

        Session::flash('alert-success','Task Taken');

        return redirect('birth-certificates/verify/'.$tab.'/processing');

    }


}
