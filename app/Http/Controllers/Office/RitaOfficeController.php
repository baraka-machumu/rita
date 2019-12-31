<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\RegisteredHosp;
use App\RitaOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RitaOfficeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public  function  index(){



            $offices  =  RitaOffice::all()->toArray();

            return  view('offices.index',compact('offices'));
    }


    public  function  create(){

        $regions  =  DB::table('Region')->get();

        return  view('offices.create',compact('regions'));

    }
}
