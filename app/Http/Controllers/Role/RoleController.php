<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function  index() {


        $roles  =  DB::table('Role')->get();

        return view('roles.index',compact('roles'));


    }

    public  function  create(){


        $permissions  =  Permission::all()->toArray();
        return view('roles.create',compact('permissions'));

    }

    public  function  store(Request $request){

        $roleName   = $request->name;

        $permissions =  $request->permission;

//        dd($permissions);

        $role  = new Role();

        $roleData=  Role::orderBy('RoleID','desc')->first();


        $roleID = 1;

        if ($roleData){

            $roleID =  $roleData->RoleID+1;

        }

        $role->RoleName  = $roleName;
        $role->RoleID =  $roleID;

        $success = $role->save();


        if ($success){



            foreach($permissions as $key=>$value){
                $rolePermissionData=  RolePermission::orderBy('RolePermissionID','desc')->first();

                $rolePermissionID = 1;
                if ($rolePermissionData){

                    $rolePermissionID = $rolePermissionData->RolePermissionID+1;
                }
                $rolePermission =  new RolePermission();

                $rolePermission->RoleID = $role->RoleID;
                $rolePermission->PermissionID = $value;
                $rolePermission->RolePermissionID = $rolePermissionID;

                $rolePermission->save();

            }




        }
        return  redirect('roles');

    }


    public  function  edit($roleId){

        $permissions  =  Permission::all()->toArray();

        $roleName   =  Role::where('RoleID',$roleId)->first()->RoleName;

        $role  = DB::table('RolePermission as rp')
                ->select('rp.PermissionID')
                ->where('rp.RoleID','=',$roleId)
//                ->join('Role as r','rp.RoleID','=','r.RoleID')
                ->get();

//        return response()->json($role);

        return view('roles.edit',compact('role','roleId','permissions','roleName'));

    }


    public  function  update(Request $request, $roleId){


        $roleName   = $request->name;

        $permissions =  $request->permission;

        $success  = Role::where('RoleID',$roleId)->update(['RoleName'=>$roleName]);

        if ($success && !$permissions) {

            Session::flash('alert-success',' Successful Updated');

            return redirect('roles');

        }


        if ($success){

            RolePermission::where('RoleID',$roleId)->delete();

            foreach($permissions as $key=>$value){
                $rolePermissionData=  RolePermission::orderBy('RolePermissionID','desc')->first();

                $rolePermissionID = 1;
                if ($rolePermissionData){

                    $rolePermissionID = $rolePermissionData->RolePermissionID+1;
                }
                $rolePermission =  new RolePermission();

                $rolePermission->RoleID =$roleId;
                $rolePermission->PermissionID = $value;
                $rolePermission->RolePermissionID = $rolePermissionID;

                $rolePermission->save();

            }




        }
        return  redirect('roles');

    }


    public  function  delete(){

        return view('roles.create');

    }


}
