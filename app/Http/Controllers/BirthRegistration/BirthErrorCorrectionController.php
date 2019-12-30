<?php

namespace App\Http\Controllers\BirthRegistration;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BirthErrorCorrectionController extends Controller
{


    // function data handle all new birth registrations. goes here.
    public  function index($tab) {

        $dublicates =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('sap.HandlerID','=',null)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->get();

        $myTaskDuplicates=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->get();

        return view('births.change_certificate_details.tab_error',compact('tab','dublicates','myTaskDuplicates'));

    }

    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        return redirect('birth-certificates/correction/'.$tab.'/request');

    }


    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search = false;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->first();


//        return response()->json($ddata);
        return view('births.change_certificate_details.view_error_data',compact('issue_search','is_result','verify','issue','ddata'));

    }

    public function serachByEntryNumber(Request $request,$trackerId){

        $entryNo = $request->entryNo;

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

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('EntryNo','=',$entryNo)->first();

        $verify =  true;
        $issue  =  false;
        $is_result= true;
        $issue_search = true;


        return view('births.change_certificate_details.view_error_data',compact('issue_search','is_result','verify','issue','ddata','result'));

    }

    public  function  verify(Request $request,$trackerId){

        $comment  =  $request->comment;

//        $trackerId  = $request->trackerId;

        $status =  3;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $result  = $this->changeDetails($request);

       // return response()->json($result);

        Session::flash('alert-success','Successful changed.');

        CommentController::commentSave($request,Auth::user()->StaffID,$trackerId,"Verify");

        return redirect('birth-certificates/correction/1/request');

    }


    public  function returnRequest(Request $request,$trackerId){


        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)
            ->update(['HandlerID'=>null,'ApplicationStatusID'=>1]);




        if ($success){

            Session::flash('alert-success','Successful returned.');

        } else{

            Session::flash('alert-success','An Error Occurred.');

        }

        $handlerId =  Auth::user()->StaffID;

        CommentController::commentSave($request,$handlerId,$trackerId,"Error Correction");


        return redirect('birth-certificates/correction/2/request');


    }



    //issue

    public  function issueRequest($tab) {

        $issues =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
//            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->where('sap.ApplicationStatusID','=',3)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->get();

        $printed=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('sap.ApplicationStatusID','=',5)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->get();

        return view('births.change_certificate_details.tab_issue',compact('tab','issues','printed'));

    }


    public  function  viewIssueRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search  =  true;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->first();

//        return response()->json($ddata);
        return view('births.change_certificate_details.view_issue_error_data',compact('issue_search','is_result','verify','issue','ddata'));

    }


    public  function issueSerachByEntryNumber(Request $request,$trackerId){

        $entryNo = $request->entryNo;

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

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('EntryNo','=',$entryNo)->first();

//                    return response()->json($result);


        $verify =  true;
        $issue  =  false;
        $is_result= true;

        return view('births.change_certificate_details.view_issue_error_data',compact('is_result','verify','issue','ddata','result'));

    }

    public  function  issueStore(Request $request,$trackerId){

        $status =  5;

        $type  = 5;

        $servApp  = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->first();

        $applicationId =  $servApp->ApplicationID;
        $entryNo  =  DB::table('BirthService')->where('BirthServID',$applicationId)->first()->EntryNo;



        if (!$entryNo){

            Session::flash('alert-danger','The Entry Number Is Not Valid Number.');

            return redirect('birth-certificates/correction/view-issue-request/'.$trackerId);

        }

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $handlerId  =  Auth::user()->StaffID;

        CommentController::commentSave($request,$handlerId,$trackerId,"Verify");


        return redirect('/reports/certificate/'.$entryNo.'/view/'.$type);

    }



    public  function  changeDetails(Request $request){

        $cFirstName  =  $request->cfirstName;
        $cMiddleName  =  $request->cmiddleName;
        $cLastName  =  $request->clastName;
        $chospital  =  $request->chospital;
        $dob  =  $request->dob;
        $mFirstName  =  $request->mFirstName;
        $mMiddleName  =  $request->mMiddleName;
        $mLastName  =  $request->mLastName;
        $mcountryBirth =  $request->mcountryBirth;
        $ffirstName =  $request->ffirstName;
        $fMiddleName  =  $request->fMiddleName;
        $fLastName  =  $request->fLastName;
        $fcountryBirth  =  $request->fcountryBirth;

        $correctionFlag  =  $request->correctionFlag;
        $entryNo  =  $request->entryNo;

        $staffId =  Auth::user()->StaffID;
        $applicationId =  $request->applicationId;
        $frontUserId =  $request->frontUserId;


        if ($correctionFlag==100){

            $result = DB::update('EXEC  Update_Childinfo_SP  ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?',
                array($entryNo,$cFirstName,$cMiddleName,$cLastName,null,$mFirstName,$mMiddleName,$mLastName,null,
                    $ffirstName,$fMiddleName,$fLastName,null,null,$dob,null,null,$chospital,'Y','N','N',
                    $applicationId,$frontUserId,$staffId)
            );

//            return $result;

//            return response()->json($result);
        }


    }




}
