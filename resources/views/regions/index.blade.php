
@extends('layouts.master')



@section('heading-title')

    <h2>Hospitals</h2>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <a href="{{url('regions/create')}}" class="btn btn-success">New Region</a>
            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Region Name</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($regions as $index=>$region)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$region['RegionalName']}}</td>
                        <td>
                            <a href="{{route('region-edit',$region['RegionalID'])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                            <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
