
@extends('layouts.master')



@section('heading-title')

    <h2>Registered Birth Certificates</h2>
@endsection

@section('content')

    <div class="row">


        <div class="col-md-12">

            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Role Name</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($roles as $index=>$role)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$role->RoleName}}</td>
                        <td>
                            <a href="#" class="btn btn-success"><i class="fa fa-edit"></i></a>

                            <a href="#" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
