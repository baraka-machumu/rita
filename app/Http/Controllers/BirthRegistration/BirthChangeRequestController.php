<?php

namespace App\Http\Controllers\BirthRegistration;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BirthChangeRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    // function data handle all new birth registrations. goes here.
    public  function index($tab) {

        $dublicates =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',null)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        if (Auth::user()->IsHQ==1){

            $dublicates =     DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',7)
                ->where('sap.HandlerID','=',null)
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();


        }

            $myTaskDuplicates=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

//        return response()->json($myTaskDuplicates);
        return view('births.replace_old_certificate.tab_replace',compact('tab','dublicates','myTaskDuplicates'));

    }


    // function to assign task to rita staff
    public  function  myTask($trackerId){


        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;
        Session::flash('alert-success','Task Taken');

        return redirect('birth-certificates/replace/'.$tab.'/request');

    }


    public  function  viewRequest($trackerId){


        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;

        $is_check_modal=  false;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->first();

//        dd(444);
        return view('births.replace_old_certificate.view_replace_data',compact('is_check_modal','is_result','verify','issue','ddata'));

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

        $result=  DB::table('DataInfo as d')
            ->where('d.EntryNo','=',$entryNo)
            ->join('Sex','Sex.SexID','=','d.SexID')
//            ->join('Country as cn','cn.CountryID','=','d.ChildNationalityID')
//            ->join('Country as mn','mn.CountryID','=','d.MotherNationalityID')
//            ->join('Country as fn','fn.CountryID','=','d.FatherNationalityID')
            ->first();

//        return response()->json($result);
        $verify =  true;
        $issue  =  false;
        $is_result= true;
        $is_check_modal=  true;


        return view('births.replace_old_certificate.view_replace_data',compact('is_check_modal','is_result','verify','issue','ddata','result'));


    }

    public  function  verify(Request $request,$trackerId){

        $comment  =  $request->comment;

        $status =  3;

        $handlerId  =  Auth::user()->StaffID;
        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        CommentController::commentSave($request,$handlerId,$trackerId,"Verify");

        return redirect('birth-certificates/replace/1/request');

    }

    //issue

    public  function issueRequest($tab) {

        $issues =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
//            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->where('sap.ApplicationStatusID','=',3)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        if (Auth::user()->IsHQ==1){
            $issues =     DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',7)
//                ->where('sap.HandlerID','=',Auth::user()->StaffID)
                ->where('sap.ApplicationStatusID','=',3)
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        }


            $printed=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('sap.ApplicationStatusID','=',5)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();


        return view('births.replace_old_certificate.tab_issue',compact('tab','issues','printed'));

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
        $comments  =  CommentController::getComments($trackerId);


        return view('births.replace_old_certificate.view_issue_replace_data',compact('comments','issue_search','is_result','verify','issue','ddata'));

    }



    public  function issueSerachByEntryNumber(Request $request,$trackerId){

        $entryNo =  $request->entryNo;//'192005962068';//


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

        $result=   DB::table('DataInfo as d')
            ->where('d.EntryNo','=',$entryNo)
            ->join('Sex','Sex.SexID','=','d.SexID')->first();


        $verify =  true;
        $issue  =  true;
        $is_result= true;
        $issue_search  =  true;
        $comments  =  CommentController::getComments($trackerId);

        return view('births.replace_old_certificate.view_issue_replace_data',compact('issue_search','comments','is_result','verify','issue','ddata','result'));

    }

    public  function  issueStore(Request  $request,$trackerId){

        $status =  5;
        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $handlerId  =  Auth::user()->StaffID;

        CommentController::commentSave($request,$handlerId,$trackerId,"Verify");

        $type  = 2;

        $servApp  = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->first();

        $applicationId =  $servApp->ApplicationID;
        $entryNo  =  DB::table('BirthService')->where('BirthServID',$applicationId)->first()->EntryNo;

        if (!$entryNo){

            Session::flash('alert-danger','The Entry Number Is Not In Our Records');

            return redirect('birth-certificates/replace/view-issue-request/'.$trackerId);
        }



        return redirect('/reports/certificate/'.$entryNo.'/view/'.$type);


    }

}
