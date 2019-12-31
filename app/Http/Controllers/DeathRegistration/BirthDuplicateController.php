<?php

namespace App\Http\Controllers\DeathRegistration;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function Couchbase\defaultDecoder;

class BirthDuplicateController extends Controller
{

    // function data handle all new birth registrations. goes here.
    public  function index($tab) {

        $dublicates =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',8)
            ->where('sap.HandlerID','=',null)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->get();

        $myTaskDuplicates=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',8)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->get();


        return view('deaths.duplicate_certificate.tab_duplicate',compact('tab','dublicates','myTaskDuplicates'));

    }


    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        Session::flash('alert-success','Task Taken');

        return redirect('death-certificates/duplicate/'.$tab.'/request');

    }


    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search =  false;
        $is_check_modal=  false;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',8)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->first();


        return view('deaths.duplicate_certificate.view_duplicate_data',compact('is_check_modal','issue_search','is_result','verify','issue','ddata'));

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
            ->where('sap.ServiceTypeID','=',8)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo as di')
            ->where('di.DeathEntryNo','=',$entryNo)
//                      ->join('DeathService as ds','ds.DeathServID','=','di.PersonalID')
//            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')

            ->first();

//        return response()->json($result);

        $verify =  true;
        $issue  =  false;
        $is_result= true;
        $issue_search =  false;
        $is_check_modal=  true;


        return view('deaths.duplicate_certificate.view_duplicate_data',compact('is_check_modal','issue_search','is_result','verify','issue','ddata','result'));


    }

    public  function  verify(Request $request,$trackerId){

        $status =  3;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        Session::flash('alert-success','Successful Verified');

        return redirect('death-certificates/duplicate/2/request');

    }

    //issue

    public  function issueRequest($tab) {

        $issues =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',8)
//            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->where('sap.ApplicationStatusID','=',3)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->get();

        $printed=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',8)
            ->where('sap.ApplicationStatusID','=',5)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->get();

        return view('deaths.duplicate_certificate.tab_issue',compact('tab','issues','printed'));

    }


    public  function  viewIssueRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search  =  true;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',8)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->first();

//        return response()->json($ddata);
        return view('deaths.duplicate_certificate.view_issue_duplicate_data',compact('issue_search','is_result','verify','issue','ddata'));

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
            ->where('sap.ServiceTypeID','=',8)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('DeathEntryNo','=',$entryNo)->first();

        $verify =  true;
        $issue  =  false;
        $is_result= true;
//        $issue_search =  false;

        return view('deaths.duplicate_certificate.view_issue_duplicate_data',compact('is_result','verify','issue','ddata','result'));

    }

    public  function  issueStore(Request $request,$trackerId){

        $status =  5;
        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $handlerId  =  Auth::user()->StaffID;

        $type = 4; // death duplicate certificate.

        $entryNo  =  $request->entryNo;


        CommentController::commentSave($request,$handlerId,$trackerId,"Issue and print");

        return redirect('/reports/certificate/'.$entryNo.'/view/'.$type);

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

}
