<?php

namespace App\Http\Controllers\Region;

use App\Http\Controllers\Controller;
use App\Region;
use App\StaffRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    //

    public  function  index(){

        $regions  =  Region::all()->toArray();

        return view('regions.index',compact('regions'));

    }

    public  function  create(){

        $regions  =  Region::orderBy('RegionalID', 'desc')->paginate(6);

        return view('regions.create',compact('regions'));

    }

    public  function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'postCode' => 'required|min:2',

        ]);

        if ($validator->fails()){

            Session::flash('alert-warning',' Please Fill All The Field(s)');

            return  redirect()->back()->withInput();

        }

        $name  =  $request->name;
        $postalCode  =  $request->postCode;

        $result = DB::select('EXEC  Save_Region_SP ?,?',array($name,$postalCode));

        if ($result[0]->resultCode==0){

            Session::flash('alert-success','Successful Created');

        }

        else {

            Session::flash('alert-danger', 'Failed to Create');

        }

        return redirect('regions/create');

    }


    public  function  edit($regionId){

        $region  =  Region::where('RegionalID',$regionId)->first();

        return view('regions.edit',compact('region','regionId'));


    }


    public  function  update(Request $request, $regionId){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'postCode' => 'required|min:2',

        ]);

        if ($validator->fails()){

            Session::flash('alert-warning',' Please Fill All The Field(s)');

            return  redirect()->back()->withInput();

        }

        $name  =  $request->name;
        $postCode  =  $request->postCode;

        $result = Region::where('RegionalID',$regionId)->update(['RegionalName'=>$name,'PostCode'=>$postCode]);

        if ($result){

            Session::flash('alert-success','Successful Updated');

        }

        else {

            Session::flash('alert-danger', 'Failed to Update');

        }

        return redirect('regions');

    }

}
