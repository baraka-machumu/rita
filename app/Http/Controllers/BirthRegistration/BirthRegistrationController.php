<?php

namespace App\Http\Controllers\BirthRegistration;

use App\Comment;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Jaspersoft\Client\Client;

class BirthRegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // function data handle all new birth registrations. goes here.
    public  function index($tab) {

        return $this->getRegistrationDetails($tab);

    }


    public  function  newRequest($tab){

        $newBirthRegistrations =  DB::table('ServApplicationTracker as sap')
            ->where('HandlerID','=',null)
            ->where('sap.NearestRitaOfficeID',Auth::user()->RitaOfficeID)
            ->select('as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        if (Auth::user()->IsHQ==1){

            $newBirthRegistrations =  DB::table('ServApplicationTracker as sap')
                ->where('HandlerID','=',null)
                ->select('as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
                ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
                ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

                ->get();
        }

        $handlerId  =  Auth::user()->StaffID;
        $statusCode  =  300;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $newBirthRegPendings =  DB::table('ServApplicationTracker as sap')
            ->where([
                ['HandlerID','=',$handlerId],
                ['sap.ApplicationStatusID','=',$statusId],
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        return view('births.new_certificate.tab_request',compact('newBirthRegPendings','tab','newBirthRegistrations'));

    }

    //processing


    public  function  newProcessing($tab){

        $handlerId  =  Auth::user()->StaffID;
        $statusCode  =  301;

        $ritaOfficeId  =  Auth::user()->RitaOfficeID;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $newBirthRegProcessingRequests =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.ApplicationStatusID','=',$statusId],
                ['sap.ProcessingOfficeID','=',$ritaOfficeId]
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        if (Auth::user()->IsHQ==1){

            $newBirthRegProcessingRequests =  DB::table('ServApplicationTracker as sap')

                ->where([

                    ['sap.ApplicationStatusID','=',$statusId],

                ])
                ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
                ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
                ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

                ->get();
        }


        $newBirthRegProcessingTasks =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.NextToActID','=',$handlerId],
                ['sap.ProcessingOfficeID','=',$ritaOfficeId],
                ['sap.ApplicationStatusID','=',$statusId],

            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        return view('births.new_certificate.tab_processing',compact('newBirthRegProcessingTasks','tab','newBirthRegProcessingRequests'));

    }

    //issue
    public  function  newIssue($tab){


        //issuse tab

        $statusCode  =  307;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;
        $ritaOfficeId  =  Auth::user()->RitaOfficeID;

        $newBirthRegissues =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.ApplicationStatusID','=',$statusId],
                ['sap.NearestRitaOfficeID','=',$ritaOfficeId]
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();


        if (Auth::user()->IsHQ==1){
            $newBirthRegissues =  DB::table('ServApplicationTracker as sap')

                ->where([

                    ['sap.ApplicationStatusID','=',$statusId],

                ])
                ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
                ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
                ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
                ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
                ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
                ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

                ->get();
        }

        //printed tab

        $statusCode  =  303;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $newBirthprints =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.ApplicationStatusID','=',$statusId],
                ['sap.NearestRitaOfficeID','=',$ritaOfficeId]
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        return view('births.new_certificate.tab_issue',compact('newBirthRegissues','tab','newBirthprints'));

    }


    public  function pendingTask($trackerId) {

        $handlerId  =  Auth::user()->StaffID;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;
        Session::flash('alert-success','Task Taken');

        return redirect('birth-certificates/'.$tab.'/new-request');

    }



    public  function viewRequestDetails($trackerId){

        $processing =  false;
        $verify =  true;
        $issue =  false;


        $childInfo =  $this->getChildInfo($trackerId);
        $motherInfo =  $this->getMotherInfo($trackerId);
        $fatherInfo =  $this->getFatherInfo($trackerId);

//        return response()->json($motherInfo);
        $attachments  =  DB::table('ApplAttachment as aa')
            ->join('AttachementType as at','at.AttachmentTypeID','=','aa.AttachmentTypeID')
            ->where('ApplicationID',$trackerId)->get();

        $comments  =  $this->getComments($trackerId);

        $childrenByMotherName =  HelperController::getMotherChildren($motherInfo->FirstName,$motherInfo->SurName,$childInfo->DOB);

        return view('births.new_certificate.tab_view_info',compact('childrenByMotherName','comments','verify','issue','processing','attachments','fatherInfo','childInfo','motherInfo','trackerId'));


    }

    public  function  getChildInfo($trackerId){

        $childInfo =   DB::table('ServApplicationTracker as sap')
            ->where('TrackerID','=',$trackerId)
            ->select('c.CountryName','sex.SexName','pi.Occupation','pi.Street','pi.PhysicalAddress','pi.email','pi.IdentNo','sap.NoCopyPrinted','pi.MiddleName','pi.OtherName','pi.DOB','pi.NIN','pi.PhoneNo','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','=','sap.ApplicationID')

            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('Country as c','c.CountryID','=','pi.CountryOfBirthID')
            ->join('Sex as sex','sex.SexID','=','pi.SexID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->first();

        return $childInfo;
    }

    public  function  getMotherInfo($trackerId){

        $motherInfo =   DB::table('ServApplicationTracker as sap')
            ->where('TrackerID','=',$trackerId)
            ->select('c.CountryName','sex.SexName','pi.Occupation','pi.Street','pi.PhysicalAddress','pi.email','pi.IdentNo','sap.NoCopyPrinted','pi.MiddleName','pi.OtherName','pi.DOB','pi.NIN','pi.PhoneNo','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','=','sap.ApplicationID')

            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.MotherID')
            ->join('Country as c','c.CountryID','=','pi.CountryOfBirthID')
            ->join('Sex as sex','sex.SexID','=','pi.SexID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->first();

        return $motherInfo;
    }

    public  function  getFatherInfo($trackerId){

        $fatherInfo =   DB::table('ServApplicationTracker as sap')
            ->where('TrackerID','=',$trackerId)
            ->select('c.CountryName','sex.SexName','pi.Occupation','pi.Street','pi.PhysicalAddress','pi.email','pi.IdentNo','sap.NoCopyPrinted','pi.MiddleName','pi.OtherName','pi.DOB','pi.NIN','pi.PhoneNo','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','=','sap.ApplicationID')

            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.FatherID')
            ->join('Country as c','c.CountryID','=','pi.CountryOfBirthID')
            ->join('Sex as sex','sex.SexID','=','pi.SexID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->first();

        return $fatherInfo;
    }

    public  function  getRegistrationDetails($tab){


        $newBirthRegistrations =  DB::table('ServApplicationTracker as sap')
            ->where('HandlerID','=',null)
            ->where('sap.ProcessingOfficeID',Auth::user()->RitaOfficeID)
            ->select('as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        $handlerId  =  Auth::user()->StaffID;
        $statusCode  =  300;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $newBirthRegPendings =  DB::table('ServApplicationTracker as sap')
            ->where([
                ['HandlerID','=',$handlerId],
                ['sap.ApplicationStatusID','=',$statusId],
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();


        $ritaOfficeId  =  Auth::user()->RitaOfficeID;


        $statusCode  =  301;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;


        $newBirthRegProcessingRequests =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.ApplicationStatusID','=',$statusId],
                ['sap.ProcessingOfficeID','=',$ritaOfficeId]
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();


        $newBirthRegProcessingTasks =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.NextToActID','=',$handlerId],
                ['sap.ProcessingOfficeID','=',$ritaOfficeId]
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();


        //issuse tab

        $statusCode  =  307;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;


        $newBirthRegissues =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.ApplicationStatusID','=',$statusId],
                ['sap.NearestRitaOfficeID','=',$ritaOfficeId]
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();



        //printed tab

        $statusCode  =  303;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;


        $newBirthprints =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.ApplicationStatusID','=',$statusId],
                ['sap.NearestRitaOfficeID','=',$ritaOfficeId]
            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as bs','bs.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','bs.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();
//        return response()->json($newBirthRegProcessingTasks);

        return view('births.new_certificate.tab_request',compact('newBirthRegissues','newBirthprints','newBirthRegProcessingTasks','newBirthRegProcessingRequests','tab','newBirthRegistrations','newBirthRegPendings'));

    }


    public  function  verify(Request $request, $trackerId){


        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  301;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);

        if ($success){

            $this->commentSave($request,$handlerId,$trackerId,"Request");

            Session::flash('alert-success','Successful Verified');

        }

        else {

            Session::flash('alert-danger', 'Failed to Verify');

        }


        $tab  =  2;

        return redirect('birth-certificates/'.$tab.'/new-request');

    }

    public  function  processingRequest($trackerId){

        $nextToActId =  Auth::user()->StaffID;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['NextToActID'=>$nextToActId]);

        $tab  =  2;
        Session::flash('alert-success','Task Taken');


        return redirect('birth-certificates/'.$tab.'/new-processing');

    }

    public  function  viewProcessingTask($trackerId){

        $processing =  true;
        $verify =  false;
        $issue =  false;

        $childInfo =  $this->getChildInfo($trackerId);
        $motherInfo =  $this->getMotherInfo($trackerId);
        $fatherInfo =  $this->getFatherInfo($trackerId);

        $attachments  =  DB::table('ApplAttachment as aa')
            ->join('AttachementType as at','at.AttachmentTypeID','=','aa.AttachmentTypeID')
            ->where('ApplicationID',$trackerId)->get();
//        dd($trackerId);
        $comments  =  $this->getComments($trackerId);

        $childrenByMotherName =  HelperController::getMotherChildren($motherInfo->FirstName,$motherInfo->SurName,$childInfo->DOB);

        return view('births.new_certificate.tab_view_info',compact('childrenByMotherName','comments','verify','issue','processing','attachments','fatherInfo','childInfo','motherInfo','trackerId'));


    }



    public  function  approve(Request $request, $trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  307;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);

        if ($success){

            $this->commentSave($request,$handlerId,$trackerId,"Approve");

            Session::flash('alert-success','Successful Approved');
        }

        else {

            Session::flash('alert-danger', 'Failed to Approve');

        }

        $tab  =  2;
        return redirect('birth-certificates/'.$tab.'/new-processing');
    }

    public  function  viewIssue($trackerId){
        $processing =  false;
        $verify =  false;
        $issue =  true;
        $childInfo =  $this->getChildInfo($trackerId);
        $motherInfo =  $this->getMotherInfo($trackerId);
        $fatherInfo =  $this->getFatherInfo($trackerId);

        $attachments  =  DB::table('ApplAttachment as aa')
            ->join('AttachementType as at','at.AttachmentTypeID','=','aa.AttachmentTypeID')
            ->where('ApplicationID',$trackerId)->get();

        $comments  =  $this->getComments($trackerId);

//        return response()->json($childInfo);

        $childrenByMotherName =  HelperController::getMotherChildren($motherInfo->FirstName,$motherInfo->SurName,$childInfo->DOB);

//        return response()->json($childrenByMotherName);

        return view('births.new_certificate.tab_view_info',compact('childrenByMotherName','comments','verify','issue','processing','attachments','fatherInfo','childInfo','motherInfo','trackerId'));

    }

    public  function  storeIssue(Request $request,$trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  303;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);

        $servApp  = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->first();

        $applicationId =  $servApp->ApplicationID;
//        dd($applicationId);
        $servTypeId  =  1;//$servApp->ServiceTypeID;


        CommentController::commentSave($request,$handlerId,$trackerId,"Issue");


       DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['NoCopyPrinted'=>$servApp->NoCopyPrinted+1]);

        $result = DB::select('EXEC  Update_ApplicationEntryNo_SP ?,?,?,?',array($applicationId,$servTypeId,$handlerId,null));

//        return $result;

        if ($result[0]->resultCode==0){

            $entryNo  =  DB::table('BirthService')->where('BirthServID',$applicationId)->first()->EntryNo;
            Session::flash('alert-success','Successful issued now you can print');

            return redirect('birth-certificates/new-certificate/print/'.$entryNo);

        }


        else {

            Session::flash('alert-danger', 'Failed to issue');

        }

        $tab  =  2;
        return redirect('birth-certificates/'.$tab.'/new-issue');

    }


    public  function  newCertificatePrint($entryNo){


        return view('births.new_certificate.view_new_certificate_to_print',compact('entryNo'));

    }

    public  function  certificate($entryNo){

        $url  =  "http://localhost:8080/jasperserver";
        $user  =  "jasperadmin";
        $password  =  "jasperadmin";

        $server  =  new Client($url,$user,$password);

        $report_url =  "/reports/rita/birth_certificate";

        $inputControls   = [

            'EntryNo'=>$entryNo
        ];

        $getReport  =  $server->reportService()->runReport($report_url,'pdf',null,null,$inputControls);
        header('Content-Type: application/pdf');
            echo   $getReport;

    }

    public  function  commentSave(Request $request, $handlerId,$trackerId,$type){

        $comment  =  new Comment();

        $comment->Comment  =  $request->comments;
        $comment->StaffID  =  $handlerId;
        $comment->TrackerID  =  $trackerId;
        $comment->CommentType  =  $type;
        $comment->save();
    }



    public  function  getComments($trackerId){

       $comments  =  DB::table('Comments as c')
           ->select('s.Username','c.CommentType','c.Comment','c.TrackerID','c.Date')
           ->where('c.TrackerID','=',$trackerId)
            ->join('Staff as s','s.StaffID','=','c.StaffID')
            ->get();

       return $comments;

    }
}
