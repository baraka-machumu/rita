<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Region;
use App\RegisteredHosp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function  index()
    {

        $hospitals  =  RegisteredHosp::all()->toArray();

        return  view('healths.index',compact('hospitals'));
    }


    public  function  create() {


        $regions  =  DB::table('Region')->get();

        return view('healths.create',compact('regions'));
    }

    public  function  store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'district' => 'required|min:2',

        ]);


        if ($validator->fails()){

            Session::flash('alert-warning',' Please Fill All The Field(s)');

            return  redirect()->back()->withInput();

        }


        $name  =  $request->name;
        $district =  $request->district;

        $result = DB::select('EXEC  Save_Hospital_SP ?,?',array($name,$district));

        if ($result[0]->resultCode==0){

            Session::flash('alert-success','Successful Created');

        }

        else {

            Session::flash('alert-danger', 'Failed to Create');

        }


        return redirect('regions/create');

    }


}
