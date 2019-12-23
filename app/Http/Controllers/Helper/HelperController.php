<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    //


    public static function  canVNewRequestCert(){

        $staffId  =  Auth::user()->StaffID;



    }
}
