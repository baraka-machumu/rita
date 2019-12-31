<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
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
}
