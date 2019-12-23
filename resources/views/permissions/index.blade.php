
@extends('layouts.master')



@section('heading-title')

    <h2>Permissions</h2>
@endsection

@section('content')

    <div class="row">


        <div class="col-md-12">

            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Permission  Name</th>
                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                @foreach($permissions as $index=>$permission)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$permission->PermissionName}}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                            <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
