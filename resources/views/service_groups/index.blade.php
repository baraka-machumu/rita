
@extends('layouts.master')



@section('heading-title')

    <h2>Offices</h2>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

{{--            <a href="{{url('offices/create')}}" class="btn btn-success">New Office</a>--}}
            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Office Name</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($offices as $index=>$office)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$office['OfficeName']}}</td>
                        <td>
                            <a href="{{route('office-edit',$office['RitaOfficeID'])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                            <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
