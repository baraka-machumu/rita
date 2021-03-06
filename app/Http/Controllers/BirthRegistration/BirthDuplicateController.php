<?php

namespace App\Http\Controllers\BirthRegistration;

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BirthDuplicateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // function data handle all new birth registrations. goes here.
    public  function index($tab) {

        $duplicates =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.HandlerID','=',null)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
            ->select('sap.TrackerID','sap.CreatedDate','sap.ApplicationID','as.StatusName','bd.ChildFname','bd.ChildMname','bd.ChildSurname','st.ServTypeName','ro.OfficeName',
                'nro.OfficeName as NearestOfficeName')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->latest("sap.CreatedDate")->get();

        if (Auth::user()->IsHQ==1){

            $duplicates =     DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',2)
                ->where('sap.HandlerID','=',null)

                ->select('sap.TrackerID','sap.CreatedDate','sap.ApplicationID','as.StatusName','bd.ChildFname','bd.ChildMname','bd.ChildSurname','st.ServTypeName','ro.OfficeName',
                    'nro.OfficeName as NearestOfficeName')
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
                ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->latest("sap.CreatedDate")->get();


        }


            $myTaskDuplicates=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->where('sap.HandlerID','=',Auth::user()->StaffID)
                ->select('sap.TrackerID','sap.CreatedDate','sap.ApplicationID','as.StatusName','bd.ChildFname','bd.ChildMname','bd.ChildSurname','st.ServTypeName','ro.OfficeName',
                    'nro.OfficeName as NearestOfficeName')
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
                ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->latest("sap.CreatedDate")->get();

        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

        return view('births.duplicate_certificate.tab_duplicate',compact('regions','districts','tab','duplicates','myTaskDuplicates'));

    }


    // function to assign task to rita staff
    public  function  myTask($trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;

        Session::flash('alert-success','Task Taken');

        return redirect('birth-certificates/duplicate/'.$tab.'/request');

    }


    public  function  viewRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search = false;
        $processing  =  false;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->first();


//        dd($ddata);
        return view('births.duplicate_certificate.view_duplicate_data',compact('processing','issue_search','is_result','verify','issue','ddata'));

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
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->first();

        $result=   DB::table('DataInfo as d')
            ->where('d.EntryNo','=',$entryNo)
            ->join('Sex','Sex.SexID','=','d.SexID')
            ->first();

//        return response()->json($result);
        $verify =  false;
        $issue  =  false;
        $is_result= true;
        $issue_search = true;
        $processing  =  true;



        return view('births.duplicate_certificate.view_duplicate_data',compact('processing','issue_search','is_result','verify','issue','ddata','result'));


    }

    public  function  verify(Request $request,$trackerId){

        $comment  =  $request->comment;


        $status =  3;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $handlerId  =  Auth::user()->StaffID;

        CommentController::commentSave($request,$handlerId,$trackerId,"Verify",'BirthDuplicate','DupID');

        Session::flash('alert-success','Request Verified');

        return redirect('birth-certificates/duplicate/2/request');

    }


    //process request ...............

    public  function processRequest($tab) {

        $processing =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.HandlerID','=',null)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
            ->select('sap.TrackerID','sap.CreatedDate','sap.ApplicationID','as.StatusName','bd.ChildFname','bd.ChildMname','bd.ChildSurname','st.ServTypeName','ro.OfficeName',
                'nro.OfficeName as NearestOfficeName')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->latest("sap.CreatedDate")->get();

        if (Auth::user()->IsHQ==1){

            $processing =     DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',2)
                ->where('sap.HandlerID','=',null)

                ->select('sap.TrackerID','sap.CreatedDate','sap.ApplicationID','as.StatusName','bd.ChildFname','bd.ChildMname','bd.ChildSurname','st.ServTypeName','ro.OfficeName',
                    'nro.OfficeName as NearestOfficeName')
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
                ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->latest("sap.CreatedDate")->get();


        }


        $myTaskProcessing=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.ApplicationStatusID','=',1)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)

            ->where('sap.NextToActID','=',Auth::user()->StaffID)
            ->select('sap.TrackerID','sap.CreatedDate','sap.ApplicationID','as.StatusName','bd.ChildFname','bd.ChildMname','bd.ChildSurname','st.ServTypeName','ro.OfficeName',
                'nro.OfficeName as NearestOfficeName')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as nro','nro.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->latest("sap.CreatedDate")->get();

        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

        return view('births.duplicate_certificate.tab_process',compact('regions','districts','tab','processing','myTaskProcessing'));

    }


    public  function processingMyTask($trackerId){


        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['NextToActID'=>Auth::user()->StaffID]);

        Session::flash('aler-success','Task Taken');
        return redirect('birth-certificates/duplicate/2/processing');

    }

    public  function viewProcessRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search = false;
        $processing  =  true;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->first();


//        dd($ddata);
        return view('births.duplicate_certificate.view_duplicate_data',compact('processing','issue_search','is_result','verify','issue','ddata'));

    }


    public  function approveProcessRequest(Request $request,$trackerId){

        $status =  10;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        $handlerId  =  Auth::user()->StaffID;

        CommentController::commentSave($request,$handlerId,$trackerId,"Verify",'BirthDuplicate','DupID');

        Session::flash('alert-success','Request Approved');

        return redirect('birth-certificates/duplicate/2/processing');

    }

    //issue

    public  function issueRequest($tab) {

        $issues =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
            ->where('sap.ApplicationStatusID','=',10)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->get();

        if (Auth::user()->IsHQ==1){

            $issues =     DB::table('ServApplicationTracker as sap')
                ->where('sap.ServiceTypeID','=',2)
                ->where('sap.ApplicationStatusID','=',10)
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
                ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->get();

        }

            $printed=  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.ApplicationStatusID','=',5)
            ->where('sap.HandlerID','=',Auth::user()->StaffID)
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->get();

        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();


        return view('births.duplicate_certificate.tab_issue',compact('regions','districts','tab','issues','printed'));

    }


    public  function  viewIssueRequest($trackerId){

        $handlerId  =  Auth::user()->StaffID;
        $verify =  true;
        $issue  =  false;
        $is_result= false;
        $issue_search  =  true;

        $ddata =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->first();

        return view('births.duplicate_certificate.view_issue_duplicate_data',compact('issue_search','is_result','verify','issue','ddata'));

    }



    public  function issueSerachByEntryNumber(Request $request,$trackerId){

        $entryNo  = $request->entryNo;

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
            ->where('sap.ServiceTypeID','=',2)
            ->where('sap.HandlerID','=',$handlerId)
            ->where('sap.TrackerID','=',$trackerId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->first();

        $result=  DB::table('DataInfo')->where('EntryNo','=',$entryNo)->first();

        $verify =  true;
        $issue  =  false;
        $is_result= true;

        return view('births.duplicate_certificate.view_issue_duplicate_data',compact('is_result','verify','issue','ddata','result'));

    }


    public  function  issueStore(Request $request,$trackerId){

        $status =  5;

        $entryNo =  $request->entryNo;
        if (!$entryNo){

            Session::flash('alert-danger','The Entry Number Is Not Valid Number.');

            return redirect('birth-certificates/duplicate/view-issue-request/'.$trackerId);
        }

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$status]);

        CommentController::commentSave($request,Auth::user()->StaffID,$trackerId,"Verify",'BirthDuplicate','DupID');


        return redirect('birth-certificates/new-certificate/print/'.$entryNo);



    }

}
