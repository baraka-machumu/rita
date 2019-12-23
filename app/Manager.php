<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Manager extends Model
{
    //

    public  static function  can($roleCode){


        $roleId =  DB::table('Role')->where('RoleCode',$roleCode)->first();

        $departmentId   =  Auth::user()->DepartmentID;

        $result  = DB::table('DepartmentRole as dp')
            ->select('dp.RoleID')
            ->where(['DepartmentId'=>$departmentId,'dp.RoleID'=>$roleId->RoleID])->first();

        if ($result) {

            return 1;
        }

        return 0;

    }

}
