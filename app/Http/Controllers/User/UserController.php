<?php

namespace App\Http\Controllers\User;

use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DeathRegistration\DeathDuplicateController;
use App\Permission;
use App\RitaOffice;
use App\Role;
use App\RolePermission;
use App\StaffPermission;
use App\StaffRole;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public  function  index() {

        $users  =  DB::table('Staff')
            ->select('ro.OfficeName','Staff.StaffRegNo','Username','IsActive','StaffID')
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','Staff.RitaOfficeID')
            ->get();

        return view('users.index',compact('users'));

    }

    public  function  create() {

        $offices  =  RitaOffice::all()->toArray();

        $departments  =  Department::all()->toArray();
        $roles  =  Role::all()->toArray();
        $permissions  =  Permission::all()->toArray();

//        return response()->json($offices);
        return view('users.create',compact('offices','roles','departments','permissions'));

    }



    // function to store staffs

    public  function  store(Request $request){


        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:Staff|min:5',
            'password' => 'required|min:8',
            'office' => 'required',
            'staff_reg_no'=>'required',
            'phone_number' => 'required',
            'username'=>'required|min:4',
            'permission'=>'required'

        ]);


//        dd($request->all());
        if ($validator->fails()){

            Session::flash('alert-warning',' Please Fill All The Field(s)');

            return  redirect()->back()->withInput();
        }

        $staffRegNo  =  $request->staff_reg_no;
        $username  =  $request->username;
        $office  =  $request->office;
        $email =  $request->email;
        $phoneNumber  =  $request->phone_number;
        $password  =  $request->password;
        $department =  $request->department;

        $permission =  $request->permission;
        $user  =  new User();


        $user->StaffRegNo  =  $staffRegNo;
        $user->Username  =  $username;
        $user->Password  =  Hash::make($password);
        $user->RitaOfficeID  =  $office;
        $user->Email  =  $email;
        $user->PhoneNo = $phoneNumber;
        $user->isActive  = 1; // 1 for active user
        $user->CreatedByID= Auth::user()->StffID;
        $user->DepartmentID  = $department;

        $user->CreatedDate  =  Carbon::now();

        $success  =  $user->save();

        if ($success){

            foreach($permission as $key=>$value){

                $staffRole =  new StaffPermission();

                $staffRole->PermissionID =  $value;
                $staffRole->StaffID =  $user->StaffID;

                $staffRole->save();

            }

            Session::flash('alert-success',$username.' Successful Created');

        }

        else {

            Session::flash('alert-danger', 'Failed to Create User');

        }

        return redirect('users');

    }


    public  function  edit($staffId){


        $staff =  User::where('StaffID',$staffId)->first();

        $offices  =  RitaOffice::all()->toArray();

        $roles  =  Role::all()->toArray();

        $staffpermissions =  StaffPermission::where('StaffID',$staffId)->get();
        $departments  =  Department::all()->toArray();

        $permissions  =  Permission::all()->toArray();

        return view('users.edit',compact('permissions','departments','staffId','staff','offices','roles','staffpermissions'));

    }


    public  function  update(Request $request, $staffId){


        $validator = Validator::make($request->all(), [
            'email' => 'required|min:5',
            'office' => 'required',
            'staff_reg_no'=>'required',
            'phone_number' => 'required',
            'username'=>'required|min:4',

        ]);


//        dd($request->all());
        if ($validator->fails()){

            Session::flash('alert-warning',' Please Fill All The Field(s)');

            return  redirect()->back()->withInput();
        }

        $staffRegNo  =  $request->staff_reg_no;
        $username  =  $request->username;
        $office  =  $request->office;
        $email =  $request->email;
        $phoneNumber  =  $request->phone_number;

        $roleName  =  $request->roleName;
        $department =  $request->department;

        $user  =  User::where('StaffID','=',$staffId)->first();

        $user->StaffRegNo  =  $staffRegNo;
        $user->Username  =  $username;

        $user->RitaOfficeID  =  $office;
        $user->Email  =  $email;
        $user->PhoneNo = $phoneNumber;
        $user->isActive  = 1; // 1 for active user
        $user->UpdatedByID= Auth::user()->StaffID;
        $user->UpdateDate  =  Carbon::now();
        $user->DepartmentID  = $department;

        $success  =  $user->save();

        if ($success && $roleName==null) {

            StaffRole::where('StaffID',$staffId)->delete();

            Session::flash('alert-success',$username.' Successful Updated');

            return redirect('users');

        }

        if ($success){

            StaffRole::where('StaffID',$staffId)->delete();

            foreach($roleName as $key=>$value){

                $staffRole =  new StaffRole();

                $staffRole->RoleID =  $value;
                $staffRole->StaffID =  $user->StaffID;

                $staffRole->save();

            }

            Session::flash('alert-success',$username.' Successful Updated');

        }

        else {

            Session::flash('alert-danger', 'Failed to Update User');

        }

        return redirect('users');

    }

    public  function  view($staffId) {

        $roles  =  DB::table('StaffRole')
            ->join('Role','Role.RoleID','=','StaffRole.RoleID')
            ->where('StaffID',$staffId)->get();

//        return response()->json($roles);
        $staff  =  DB::table('Staff')
            ->select('ro.OfficeName','Staff.Email','Staff.PhoneNo','Staff.StaffRegNo','Username','IsActive','StaffID')
            ->where('Staff.StaffID','=',$staffId)
            ->join('RitaOffice as ro','ro.RitaOfficeID','=','Staff.RitaOfficeID')
            ->first();

        return view('users.show',compact('staffId','staff','roles'));
    }


    public  function  loginAttemp(){


    }


}
