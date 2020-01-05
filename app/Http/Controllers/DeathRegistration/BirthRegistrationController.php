<?php

namespace App\Http\Controllers\DeathRegistration;

use App\Comment;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
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


        //ApplicationStatusID 4 == new registration for death.
        $newBirthRegistrations =  DB::table('ServApplicationTracker as sap')
            ->where('sap.HandlerID','=',null)
            ->where('sap.ServiceTypeID','=','4')
            ->where('sap.NearestRitaOfficeID',Auth::user()->RitaOfficeID)
            ->select('as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->get();

        if (Auth::user()->IsHQ==1){

            $newBirthRegistrations =  DB::table('ServApplicationTracker as sap')
                ->where('sap.HandlerID','=',null)
                ->where('sap.ServiceTypeID','=','4')
                ->select('as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
                ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
                ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
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
                ['sap.ServiceTypeID','=','4']

            ])
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();
        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

        return view('deaths.new_certificate.tab_request',compact('regions','districts','newBirthRegPendings','tab','newBirthRegistrations'));

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
            ->where('sap.ServiceTypeID','=','4')

            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        if (Auth::user()->IsHQ==1){
            $newBirthRegProcessingRequests =  DB::table('ServApplicationTracker as sap')

                ->where([

                    ['sap.ApplicationStatusID','=',$statusId],

                ])
                ->where('sap.ServiceTypeID','=','4')

                ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
                ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
                ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
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
            ->where('sap.ServiceTypeID','=','4')
            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();
        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();

        return view('deaths.new_certificate.tab_processing',compact('regions','districts','newBirthRegProcessingTasks','tab','newBirthRegProcessingRequests'));

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
            ->where('sap.ServiceTypeID','=','4')

            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        if (Auth::user()->IsHQ==1){

            $newBirthRegissues =  DB::table('ServApplicationTracker as sap')

                ->where([

                    ['sap.ApplicationStatusID','=',$statusId],
                ])
                ->where('sap.ServiceTypeID','=','4')

                ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
                ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
                ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
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
            ->where('sap.ServiceTypeID','=','4')

            ->select('sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->get();

        $regions  =  HelperController::getRegions();
        $districts =  HelperController::getDistricts();


        return view('deaths.new_certificate.tab_issue',compact('regions','districts','newBirthRegissues','tab','newBirthprints'));

    }


    public  function pendingTask($trackerId) {

        $handlerId  =  Auth::user()->StaffID;

        DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['HandlerID'=>$handlerId]);

        $tab  =  2;
        Session::flash('alert-success', 'Task Taken');

        return redirect('death-certificates/'.$tab.'/new-request');

    }



    public  function viewRequestDetails($trackerId){

        $processing =  false;
        $verify =  true;
        $issue =  false;


        $childInfo =  $this->getChildInfo($trackerId);
//        $motherInfo =  $this->getMotherInfo($trackerId);
//        $fatherInfo =  $this->getFatherInfo($trackerId);

        $attachments  =  DB::table('ApplAttachment as aa')
            ->join('AttachementType as at','at.AttachmentTypeID','=','aa.AttachmentTypeID')
            ->where('ApplicationID',$trackerId)->get();

//        return response()->json($childInfo);
        return view('deaths.new_certificate.tab_view_info',compact('verify','issue','processing','attachments','childInfo','trackerId'));


    }

    public  function  getChildInfo($trackerId){


        $childInfo =   DB::table('ServApplicationTracker as sap')
            ->where('TrackerID','=',$trackerId)
            ->select('ds.EntryNo','c.CountryName','sex.SexName','pi.Occupation','pi.Street','pi.PhysicalAddress','pi.email','pi.IdentNo','sap.NoCopyPrinted','pi.MiddleName','pi.OtherName','pi.DOB','pi.NIN','pi.PhoneNo','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')

            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('Country as c','c.CountryID','=','pi.CountryOfBirthID')
            ->join('Sex as sex','sex.SexID','=','pi.SexID')

            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')

            ->first();

        return $childInfo;
    }



    public  function  verify(Request $request, $trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  301;

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  =  $status->StatusID;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);


        if ($success){


            CommentController::commentSave($request,$handlerId,$trackerId,"Verification");

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

        Session::flash('alert-success', 'Task Taken');

        return redirect('death-certificates/'.$tab.'/new-processing');

    }

    public  function  viewProcessingTask($trackerId){

        $processing =  true;
        $verify =  false;
        $issue =  false;

        $childInfo =  $this->getChildInfo($trackerId);

        $attachments  =  DB::table('ApplAttachment as aa')
            ->join('AttachementType as at','at.AttachmentTypeID','=','aa.AttachmentTypeID')
            ->where('ApplicationID',$trackerId)->get();

        return view('deaths.new_certificate.tab_view_info',compact('verify','issue','processing','attachments','childInfo','trackerId'));


    }



    public  function  approve(Request $request, $trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $statusCode  =  307; //10

        $status  =  DB::table('ApplicationStatus')->select('StatusID')->where('StatusCode',$statusCode)->first();

        $statusId  = 10;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);

        if ($success){

//            $this->commentSave($request,$handlerId,$trackerId);

            CommentController::commentSave($request,$handlerId,$trackerId,"Approve");

            Session::flash('alert-success','Successful Approved');
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


//        return response()->json($childInfo);
        $attachments  =  DB::table('ApplAttachment as aa')
            ->join('AttachementType as at','at.AttachmentTypeID','=','aa.AttachmentTypeID')
            ->where('ApplicationID',$trackerId)->get();

        return view('deaths.new_certificate.tab_view_info',compact('verify','issue','processing','attachments','childInfo','trackerId'));

    }

    public  function  storeIssue(Request $request,$trackerId){

        $handlerId  =  Auth::user()->StaffID;

        $statusId  =  5;

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)->update(['ApplicationStatusID'=>$statusId]);

        $servApp  = DB::table('ServApplicationTracker')->select('ApplicationID')->where('TrackerID',$trackerId)->first();

        $applicationId =  $servApp->ApplicationID;
        $servTypeId  =  4;

        CommentController::commentSave($request,$handlerId,$trackerId,"Approve");

        $birthEntryNo =  $request->entryNo;

//        dd($applicationId);
        $result = DB::select('EXEC  Update_ApplicationEntryNo_SP ?,?,?,?',array($applicationId,$servTypeId,$handlerId,null));


//        return response()->json($result);
        if ($result[0]->resultCode==0){

            $entryNo  =  DB::table('DeathService')->where('DeathServID',$applicationId)->first()->EntryNo;

            Session::flash('alert-success','Successful issued now you can print');

            $type = 4;

            return redirect('/reports/certificate/'.$entryNo.'/view/'.$type);

//            return redirect('death-certificates/new-certificate/print/'.$entryNo);

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
