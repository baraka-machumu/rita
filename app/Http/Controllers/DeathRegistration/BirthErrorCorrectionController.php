<?php

namespace App\Http\Controllers\DeathRegistration;

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
            ->where('sap.ServiceTypeID','=',9)
            ->where('sap.HandlerID','=',null)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->get();

        $myTaskDuplicates=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',9)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->get();

        return view('deaths.change_certificate_details.tab_error',compact('tab','dublicates','myTaskDuplicates'));

    }

    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        return redirect('death-certificates/correction/'.$tab.'/request');

    }


    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search = false;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',9)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->first();


//        return response()->json($ddata);
        return view('deaths.change_certificate_details.view_error_data',compact('issue_search','is_result','verify','issue','ddata'));

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
            ->where('sap.ServiceTypeID','=',9)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('DeathEntryNo','=',$entryNo)->first();

        $verify =  true;
        $issue  =  false;
        $is_result= true;
        $issue_search = true;


        return view('deaths.change_certificate_details.view_error_data',compact('issue_search','is_result','verify','issue','ddata','result'));

    }

    public  function  verify(Request $request,$trackerId){

        $status =  3;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $result  = $this->changeDetails($request);

        // return response()->json($result);

        Session::flash('alert-success','Successful changed.');

        CommentController::commentSave($request,Auth::user()->StaffID,$trackerId,"Verify");

        return redirect('death-certificates/correction/1/request');

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


        return redirect('death-certificates/correction/2/request');


    }



    //issue

    public  function issueRequest($tab) {

        $issues =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',9)
//            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->where('sap.ApplicationStatusID','=',3)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->get();

        $printed=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',9)
            ->where('sap.ApplicationStatusID','=',5)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->get();

//        return response()->json($issues);
        return view('deaths.change_certificate_details.tab_issue',compact('tab','issues','printed'));

    }

    public  function  viewIssueRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search  =  true;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',9)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->first();

//        return response()->json($ddata);
        return view('deaths.change_certificate_details.view_issue_error_data',compact('issue_search','is_result','verify','issue','ddata'));

    }


    public  function issueSerachByEntryNumber(Request $request,$trackerId){


        $entryNo = $request->entryNo;;//'192000217104';//

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
            ->where('sap.ServiceTypeID','=',9)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('DeathEntryNo','=',$entryNo)->first();

//                    return response()->json($result);


        $verify =  true;
        $issue  =  false;
        $is_result= true;

        return view('deaths.change_certificate_details.view_issue_error_data',compact('is_result','verify','issue','ddata','result'));

    }

    public  function  issueStore(Request $request,$trackerId){

        $status =  5;
        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $handlerId  =  Auth::user()->StaffID;

        CommentController::commentSave($request,$handlerId,$trackerId,"Verify");

        $type  = 6;

        $entryNo =  $request->entryNo;

        return redirect('/reports/certificate/'.$entryNo.'/view/'.$type);

//        return redirect('birth-certificates/correction/1/issue');
    }



    public  function  changeDetails(Request $request){

        $cFirstName  =  $request->cfirstName;
        $cMiddleName  =  $request->cmiddleName;
        $cLastName  =  $request->clastName;
        $chospital  =  $request->chospital;
        $dob  =  $request->dob;

        $dod =  $request->dod;
        $correctionFlag  =  $request->correctionFlag;
        $entryNo  =  $request->entryNo;

        $staffId =  Auth::user()->StaffID;
        $applicationId =  $request->applicationId;
        $frontUserId =  $request->frontUserId;

        if ($correctionFlag==100){

            $result = DB::update('EXEC  Update_DeceasedInfo_SP  ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?',
                array($entryNo,$cFirstName,$cMiddleName,$cLastName,null,null,null,$dob,$dod,null,
                    null,'Y',$applicationId,$frontUserId,$staffId,null,null,null,null,null)
            );

//         return response()->json($result);
        }

    }

}
