
@extends('layouts.master')



@section('heading-title')

    <h2>Roles</h2>
@endsection

@section('content')

    <div class="row">


        <div class="col-md-12">

            <a href="roles/create" class="btn btn-success">New Role</a>
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
                            <a href="{{route('role-edit',$role->RoleID)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                            <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
