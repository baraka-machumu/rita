<?php

namespace App\Http\Controllers\DeathRegistration;

use App\Comment;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BirthRegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // function data handle all new birth registrations. goes here.
    public  function index($tab) {

      //  return $this->getRegistrationDetails($tab);

    }


    public  function  newRequest($tab){

        $newBirthRegistrations =  DB::table('ServApplicationTracker as sap')
            ->where('HandlerID','=',null)
            ->select('as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
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
//                ['sap.HandlerID','!=',Auth::user()->StaffID]


            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        return view('deaths.new_certificate.tab_request',compact('newBirthRegPendings','tab','newBirthRegistrations'));

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
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();


        $newBirthRegProcessingTasks =  DB::table('ServApplicationTracker as sap')

            ->where([

                ['sap.NextToActID','=',$handlerId],
                ['sap.ProcessingOfficeID','=',$ritaOfficeId],
                ['sap.ApplicationStatusID','=',$statusId],

            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        return view('deaths.new_certificate.tab_processing',compact('newBirthRegProcessingTasks','tab','newBirthRegProcessingRequests'));

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
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
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
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        return view('deaths.new_certificate.tab_issue',compact('newBirthRegissues','tab','newBirthprints'));

    }


    public  function pendingTask($trackerId) {

        $handlerId  =  Auth::user()->StaffID;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;
        return redirect('death-certificates/'.$tab.'/new-request');

    }



    public  function viewRequestDetails($trackerId){

        $processing =  false;
        $verify =  true;
        $issue =  false;

        $childInfo =  $this->getChildInfo($trackerId);
        $motherInfo =  $this->getMotherInfo($trackerId);
        $fatherInfo =  $this->getFatherInfo($trackerId);

        $attachments  =  DB::table('ApplAttachment as aa')
            ->join('AttachementType as at','at.AttachmentTypeID','=','aa.AttachmentTypeID')
            ->where('ApplicationID',$trackerId)->get();

        return view('deaths.new_certificate.tab_view_info',compact('verify','issue','processing','attachments','fatherInfo','childInfo','motherInfo','trackerId'));


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

        return view('deaths.new_certificate.tab',compact('newBirthRegissues','newBirthprints','newBirthRegProcessingTasks','newBirthRegProcessingRequests','tab','newBirthRegistrations','newBirthRegPendings'));

    }


    public  function  verify(Request $request, $trackerId){


        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  301;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);


        if ($success){

            $this->commentSave($request,$handlerId,$trackerId);

            Session::flash('alert-success','Successful Verified');

        }

        else {

            Session::flash('alert-danger', 'Failed to Verify');

        }


        $tab  =  2;

        return redirect('death-certificates/'.$tab.'/new-request');

    }

    public  function  processingRequest($trackerId){

        $nextToActId =  Auth::user()->StaffID;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['NextToActID'=>$nextToActId]);

        $tab  =  2;

        return redirect('death-certificates/'.$tab.'/new-processing');

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

        return view('deaths.new_certificate.tab_view_info',compact('verify','issue','processing','attachments','fatherInfo','childInfo','motherInfo','trackerId'));


    }



    public  function  approve(Request $request, $trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  307;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);

        if ($success){

            $this->commentSave($request,$handlerId,$trackerId);

            Session::flash('alert-success','Successful Verified');
        }

        else {

            Session::flash('alert-danger', 'Failed to Verify');

        }

        $tab  =  2;
        return redirect('death-certificates/'.$tab.'/new-processing');
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

        return view('deaths.new_certificate.tab_view_info',compact('verify','issue','processing','attachments','fatherInfo','childInfo','motherInfo','trackerId'));

    }

    public  function  storeIssue(Request $request,$trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  303;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);

        $servApp  = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->first();

        $applicationId =  $servApp->ApplicationID;
        $servTypeId  =  4;//$servApp->ServiceTypeID;

        $this->commentSave($request,$handlerId,$trackerId);

        $result = DB::select('EXEC  Update_ApplicationEntryNo_SP ?,?,?',array($applicationId,$servTypeId,$handlerId));

        if ($result[0]->resultCode==0){

            Session::flash('alert-success','Successful issued');
        }

        else {

            Session::flash('alert-danger', 'Failed to issue');

        }
        $tab  =  2;
        return redirect('death-certificates/'.$tab.'/new-issue');

    }

    public  function  commentSave(Request $request, $handlerId,$trackerId){

        $comment  =  new Comment();

        $comment->Comment  =  $request->comments;
        $comment->StaffID  =  $handlerId;
        $comment->TrackerID  =  $trackerId;
        $comment->save();
    }

}
