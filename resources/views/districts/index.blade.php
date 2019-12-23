
@extends('layouts.master')



@section('heading-title')

    <h2>Hospitals</h2>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <a href="{{url('districts/create')}}" class="btn btn-success">New District</a>
            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>District Name</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($districts as $index=>$district)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$district['DistrictName']}}</td>
                        <td>
                            <a href="{{route('district-edit',$district['DistrictID'])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                            <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
