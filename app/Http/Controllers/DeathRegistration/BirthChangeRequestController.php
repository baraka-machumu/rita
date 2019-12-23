<?php

namespace App\Http\Controllers\DeathRegistration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BirthChangeRequestController extends Controller
{


    // function data handle all new birth registrations. goes here.
    public  function index($tab) {

        $dublicates =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',null)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        $myTaskDuplicates=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

//        return response()->json($myTaskDuplicates);
        return view('deaths.replace_old_certificate.tab_replace',compact('tab','dublicates','myTaskDuplicates'));

    }


    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        return redirect('death-certificates/replace/'.$tab.'/request');

    }


    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->first();

        return view('deaths.replace_old_certificate.view_replace_data',compact('is_result','verify','issue','ddata'));

    }



    public function serachByEntryNumber(Request $request,$trackerId){

        $entryNo =  $request->entryNo;

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
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('EntryNo','=',$entryNo)->first();

        $verify =  true;
        $issue  =  false;
        $is_result= true;

        return view('deaths.replace_old_certificate.view_replace_data',compact('is_result','verify','issue','ddata','result'));


    }

    public  function  verify(Request $request,$trackerId){

        $comment  =  $request->comment;


        $status =  3;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        return redirect('death-certificates/replace/1/request');

    }



    //issue

    public  function issueRequest($tab) {

        $issues =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->where('sap.ApplicationStatusID','=',3)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        $printed=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.ApplicationStatusID','=',5)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        return view('deaths.replace_old_certificate.tab_issue',compact('tab','issues','printed'));

    }


    public  function  viewIssueRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search  =  true;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->first();

//        return  response()->json($ddata);

        return view('deaths.replace_old_certificate.view_issue_replace_data',compact('issue_search','is_result','verify','issue','ddata'));

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
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('EntryNo','=',$entryNo)->first();

        $verify =  true;
        $issue  =  false;
        $is_result= true;

        return view('deaths.replace_old_certificate.view_issue_replace_data',compact('is_result','verify','issue','ddata','result'));

    }

    public  function  issueStore($trackerId){

        $status =  5;
        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        return redirect('death-certificates/replace/1/issue');

    }

}
