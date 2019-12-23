
@extends('layouts.master')



@section('heading-title')

    <h2>Departments</h2>
@endsection

@section('content')

    <div class="row">


        <div class="col-md-12">

            <a href="{{url('departments/create')}}" class="btn btn-success">New Department</a>
            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Department Name</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($departments as $index=>$department)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$department['DepartmentName']}}</td>
                        <td>
                            <a href="{{route('department-edit',$department['DepartmentID'])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                            <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
