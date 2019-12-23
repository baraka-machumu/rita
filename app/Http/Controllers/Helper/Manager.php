<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\StaffRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Manager extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public   function  hasPermission($permissionId){


        $staffId  =  Auth::user()->StaffID;

//        $newRequestCertficate  =  Config::get('permissionmapping.NewCertificateRequest');

        $role  = DB::table('RolePermission as rp')
                    ->select('rp.PermissionID')
                    ->join('StaffRole as s','s.RoleID','=','rp.RoleID')
                    ->where(['StaffID'=>$staffId,'rp.PermissionID'=>$permissionId])->distinct()->first();

        if ($role) {

            return true;
        }

        return false;
    }
}
