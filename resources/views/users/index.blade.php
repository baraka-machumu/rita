
@extends('layouts.master')

@section('heading-title')

    <h2>Users</h2>
@endsection

@section('content')

    <div class="row">


        <div class="col-md-12">

            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p>
                @endif
            @endforeach


            <a href="users/create" class="btn btn-success">New User</a>
            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Registration Number</th>
                    <th>Username</th>
                    <th>Office Name</th>
                    <th>Status</th>
                    <th>Action</th>

{{--                    <th>Status</th>--}}


                </tr>

                </thead>

                <tbody>

                @foreach($users as $index=>$user)
                    <tr>
                        <td>{{$index+1}}</td>

                        <td>{{$user->StaffRegNo}}</td>
                        <td>{{$user->Username}}</td>
                        <td>{{$user->OfficeName}}</td>
                        <td>

                           @if($user->IsActive==1)
                               Active

                                @elseif($user->IsActive==0)

                               Inactive
                            @endif


                        </td>

{{--                        <td>{{$user->IsActive}}</td>--}}

                        <td>
                            <a href="{{route('user-edit',$user->StaffID)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>


                            <a href="{{url('users/view',$user->StaffID)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection
