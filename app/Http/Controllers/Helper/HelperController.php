<?php

namespace App\Http\Controllers\Helper;

use App\District;
use App\Http\Controllers\Controller;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    //

    public static function  canVNewRequestCert(){

        $staffId  =  Auth::user()->StaffID;
    }

    public static function  getMotherChildren($motherFirstName,$motherLastName,$dob){

        $data  =  DB::select('EXEC Get_ChildbyMotherLikeNames_SP ?,?,?',array($motherFirstName,$motherLastName,$dob));

        return $data;

    }


    public  static  function  returnApplication($trackerId){

        $success = DB::table('ServApplicationTracker')->where('TrackerID',$trackerId)
            ->update(['HandlerID'=>null,'ApplicationStatusID'=>1]);

        return $success;

    }

    public  function  filterRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =  DB::table('ServApplicationTracker as sap')
//            ->where('HandlerID','=',null)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->select('ro.DistrictID','as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('BirthService as tb','tb.BirthServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','tb.ChildID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->get();

        return response()->json($data);

    }


    public  function  filterOldToNew(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =   DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        return response()->json($data);

    }

    ///duplicate

    public  function  filterDuplicateRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthDuplicate as bd','bd.DupID','sap.ApplicationID')->get();


        return response()->json($data);

    }

    public  function  filterVerificationRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =   DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthVerification as bv','bv.VerificationID','sap.ApplicationID')->get();


        return response()->json($data);

    }


    public  function  filteCorrectionRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =    DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('CorrectionError as cr','cr.CorID','sap.ApplicationID')->get();

        return response()->json($data);

    }

    public  function  filterSearchRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('ro.DistrictID','=',$district)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('BirthSearch as bv','bv.SearchID','sap.ApplicationID')->get();

        return response()->json($data);

    }


    //death

    public  function  deathFilterRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =  DB::table('ServApplicationTracker as sap')
//            ->where('HandlerID','=',null)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->select('ro.DistrictID','as.StatusCode','sap.TrackerID','as.StatusName','sap.CreatedDate','pi.FirstName','pi.SurName','sap.ApplicationID','ro.OfficeName as ProcessingOffice','ronear.OfficeName as NearOffice')
            ->join('DeathService as ds','ds.DeathServID','sap.ApplicationID')
            ->join('PersonalInfo as pi','pi.PersonalID','=','ds.DeceasedID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('RitaOffice as ronear','ronear.RitaOfficeID','=','sap.NearestRitaOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->get();

        return response()->json($data);

    }


    public  function  deathFilterOldToNew(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =   DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',7)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('OldToNew as ol','ol.OldID','sap.ApplicationID')->get();

        return response()->json($data);

    }

    ///duplicate

    public  function  deathFilterDuplicateRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =     DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',2)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathDuplicate as dd','dd.DuplicateID','sap.ApplicationID')->first();


        return response()->json($data);

    }

    public  function  deathFilterVerificationRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =   DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',6)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathVerification as bv','bv.DeathVerID','sap.ApplicationID')->get();


        return response()->json($data);

    }


    public  function  deathFilteCorrectionRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =    DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('ro.DistrictID','=',$district)
            ->where('sap.ApplicationStatusID','=',$statusId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ServiceType as st','st.ServTypeID','=','sap.ServiceTypeID')

            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathErrorCollection as cr','cr.ErrorID','sap.ApplicationID')->get();

        return response()->json($data);

    }

    public  function  deathFilterSearchRequest(Request $request){

        $district   =  $request->districtId;
        $statusId  =  $request->statusId;

        $data =  DB::table('ServApplicationTracker as sap')
            ->where('sap.ServiceTypeID','=',3)
            ->where('ro.DistrictID','=',$district)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','sap.ProcessingOfficeID')
            ->join('ApplicationStatus as as','as.StatusID','=','sap.ApplicationStatusID')
            ->join('DeathSearch as bv','bv.SearchID','sap.ApplicationID')->get();

        return response()->json($data);

    }


    public  static function  getRegions(){

        return Region::all()->toArray();
    }
    public  static  function  getDistricts(){

        return District::all()->toArray();

    }

}
