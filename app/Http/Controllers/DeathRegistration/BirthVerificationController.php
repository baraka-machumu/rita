<?php

namespace App\Http\Controllers\DeathRegistration;

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
            ->where('sap.ApplicationStatusID','=',1)

            ->where('sap.ServiceTypeID','=',11)
            ->where('sap.HandlerID','=',null)
            ->where('sap.NearestRitaOfficeID',Auth::user()->RitaOfficeID)
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->get();

        if (Auth::user()->IsHQ==1){

            $verifications=  DB::table('ServApplicationTracker as sap')
                ->select('*','nro.OfficeName as NearestOffice')
                ->where('sap.ApplicationStatusID','=',1)

                ->where('sap.ServiceTypeID','=',11)
                ->where('sap.HandlerID','=',null)
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->get();

        }

        $myTaskverifications=  DB::table('ServApplicationTracker as sap')
            ->select('*','nro.OfficeName as NearestOffice')
            ->where('sap.ServiceTypeID','=',11)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->get();

        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

//        return response()->json($verifications);
        return view('deaths.verify_certificate.tab_verify',compact('regions','districts','tab','myTaskverifications','verifications'));

    }


    // function  to view all verification pro
    public  function process($tab) {

        $verifications=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',11)
            ->where('sap.NextToActID','=',null)
            ->where('sap.ApplicationStatusID','=',3)

            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->get();

        if (Auth::user()->IsHQ==1){

            $verifications=  DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',11)
                ->where('sap.ApplicationStatusID','=',3)

                ->where('sap.NextToActID','=',null)
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->get();

        }

        $myTaskverifications=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',11)
            ->where('sap.ApplicationStatusID','=',3)
            ->where('sap.NextToActID','=',Auth::user()->StaffID)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->get();

        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

//        return response()->json($verifications);
        return view('deaths.verify_certificate.tab_verify_process',compact('regions','districts','tab','myTaskverifications','verifications'));

    }


    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;
        Session::flash('alert-success','Task Taken');

        return redirect('death-certificates/'.$tab.'/verify');

    }

    //function to view verification data

    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $is_result =  false;

        //vdata means verification data

        $vdata=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',11)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->first();

//                return response()->json($vdata);

        $attachment = $this->getAttachments($vdata->ApplicationID,"17",'11');

        return view('deaths.verify_certificate.view_verify_data',compact('vdata','is_result','attachment'));

    }


    public function serachByEntryNumber(Request $request,$trackerId){

        $entryNo =$request->entryNo;

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
            ->where('sap.ServiceTypeID','=',11)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('DeathEntryNo','=',$entryNo)->first();

        $is_result =  true;
        $attachment = $this->getAttachments($vdata->ApplicationID,"17",'11');

        return view('deaths.verify_certificate.view_verify_data',compact('attachment','vdata','result','is_result'));

    }

    public  function  response(Request $request){

        $trackerId  =  $request->trackerId;
        $searchId =  $request->verificationId;

        CommentController::commentSave($request,Auth::user()->StaffID,$trackerId,"Death Verification",'BirthVerification','VerificationID');
        $status =  8;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        return redirect('death-certificates/1/verify');

    }


    public  function  return($trackerId){


        $success  =  HelperController::returnApplication($trackerId);

        if ($success){

            Session::flash('alert-success','Successful returned');

        }
        else {

            Session::flash('alert-danger','An Error Occurred');

        }


        return redirect('death-certificates/correction/2/request');
    }


    public  function  getAttachments($applicationId,$type,$servTypeId){

        $data  =  DB::table('ApplAttachment')
            ->where(
                [
                    ['ApplicationID','=',$applicationId],
                    ['AttachmentTypeID','=',$type],
                    ['ServiceTypeID','=',$servTypeId]
                ]
            )->first();

        return $data;
    }
}
