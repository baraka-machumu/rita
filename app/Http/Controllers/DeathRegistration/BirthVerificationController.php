<?php

namespace App\Http\Controllers\DeathRegistration;

use App\Http\Controllers\Controller;
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
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.HandlerID','=',null)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();

        $myTaskverifications=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();

//        return response()->json($verifications);
        return view('births.verify_certificate.tab_verify',compact('tab','myTaskverifications','verifications'));

    }

    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        return redirect('birth-certificates/'.$tab.'/verify');

    }

    //function to view verification data

    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $is_result =  false;

        //vdata means verification data

        $vdata=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->first();

//                return response()->json($vdata);

        return view('births.verify_certificate.view_verify_data',compact('vdata','is_result'));

    }


    public function serachByEntryNumber(Request $request,$trackerId){

        $entryNo =444;// $request->entryNo;

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


        return view('births.verify_certificate.view_verify_data',compact('vdata','result','is_result'));


    }

    public  function  response(Request $request){

        $trackerId  =  $request->trackerId;
        $searchId =  $request->verificationId;
        $comment  =  $request->comment;

        DB::table('BirthVerification')->where('verificationId',$searchId)->update(['Comment'=>$comment]);

        $status =  8;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        return redirect('birth-certificates/1/verify');

    }


}
