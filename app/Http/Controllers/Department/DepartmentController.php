<?php

namespace App\Http\Controllers\Department;

use App\Department;
use App\DepartmentRole;
use App\Http\Controllers\Controller;
use App\Role;
use App\RolePermission;
use App\StaffRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{



    public  function  index() {

        $departments  =  Department::all()->toArray();

        return view('departments.index',compact('departments'));

    }



    public  function  create(){

        $roles  =  Role::where('TypeID',1)->get();

        return view('departments.create',compact('roles'));

    }


    public  function  store(Request $request){

        $departmentName   = $request->name;

        $role =  $request->role;

        $department  = new Department();

        $DepartmentData=  Department::orderBy('DepartmentID','desc')->first();

//        $DepartmentID = 1;
//
//        if ($DepartmentData){
//
//            $DepartmentID=  $DepartmentData->RoleID+1;
//
//        }

        $department->DepartmentName   = $departmentName;
//        $department->DepartmentID =  $DepartmentID;

        $success = $department->save();

        $departmentId  =  $department->DepartmentID;


        if ($success){

            foreach($role as $key=>$value){

                $staffRole =  new DepartmentRole();

                $staffRole->DepartmentID =  $departmentId;
                $staffRole->RoleID =  $value;

                $staffRole->save();

            }



        }
        return  redirect('departments');

    }



    public function  edit($departmentId) {

        $roles  =  Role::where('TypeID',1)->get();

        $department  =  Department::where('DepartmentID',$departmentId)->first();

        $departmentRole =  DepartmentRole::where('DepartmentID',$departmentId)->get();

//        return response()->json($departmentRole);
        return view('departments.edit',compact('roles','departmentId','department','departmentRole'));


    }


    public  function  update(Request $request,$departmentId){

        $departmentName   = $request->name;

        $role =  $request->role;

        $success  = Department::where('DepartmentID',$departmentId)->update(['DepartmentName'=>$departmentName]);

        if ($success && !$role) {

            Session::flash('alert-success',' Successful Updated');

            return redirect('departments');

        }


        if ($success){


            DepartmentRole::where('DepartmentID',$departmentId)->delete();

            foreach($role as $key=>$value){

                $staffRole =  new DepartmentRole();

                $staffRole->DepartmentID =  $departmentId;
                $staffRole->RoleID =  $value;

                $staffRole->save();

            }



        }
        return  redirect('departments');


    }


}
