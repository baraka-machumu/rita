<?php

namespace App\Http\Controllers\District;

use App\District;
use App\Http\Controllers\Controller;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    //


    public  function  index(){

        $districts  =  District::all()->toArray();
        return view('districts.index',compact('districts'));

    }
    public  function  create(){

        $regions  =  Region::all()->toArray();

        $districts  =  District::orderBy('RegionID', 'desc')->paginate(6);
        return view('districts.create',compact('regions','districts'));

    }

    public  function  getAll(Request $request) {


        $regionId  =  $request->get('id');

        return DB::table('District')->where('RegionID',$regionId)->get();


    }

    public  function  store(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'postCode' => 'required|min:2',
            'region'=>'required|min:1'

        ]);

        if ($validator->fails()){

            Session::flash('alert-warning',' Please Fill All The Field(s)');

            return  redirect()->back()->withInput();

        }

        $name  = $request->name;
        $postCode  =  $request->postCode;
        $regionId  =  $request->region;

        $result = DB::select('EXEC  Save_District_SP ?,?,?',array($name,$regionId,$postCode));

        if ($result[0]->resultCode==0){

            Session::flash('alert-success','Successful Created');

        }

        else {

            Session::flash('alert-danger', 'Failed to Create');

        }

        return redirect('regions/create');

    }

    public  function  edit($districtId){


        $district  =  District::where('DistrictID',$districtId)->first();
        $regions  =  Region::all()->toArray();

        return view('districts.edit',compact('district','districtId','regions'));

    }
}
