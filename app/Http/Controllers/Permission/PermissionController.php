<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public  function  index(){

        $permissions =  DB::table('permission')->get();

        return  view('permissions.index',compact('permissions'));

    }
}
