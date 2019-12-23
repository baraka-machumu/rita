
@extends('layouts.master')



@section('heading-title')

    <h2>Staff Information</h2>
@endsection

@section('content')

    <div class="row">

        <table class="table table-bordered">

            <tbody>

            <tr>
                <td>
                    <div class="col-md-12">

                        <table class="table table-striped table-bordered table-hover">
                            <tbody>

                            <tr>
                                <th>Username</th><td>{{$staff->Username}}</td>
                            </tr>

                            <tr>
                                <th>Username</th><td>{{$staff->OfficeName}}</td>
                            </tr>
                            <tr>
                                <th>Username</th><td>{{$staff->Email}}</td>
                            </tr>
                            <tr>
                                <th>Username</th><td>{{$staff->PhoneNo}}</td>
                            </tr>

                            </tbody>

                        </table>

                    </div>

                </td>
            </tr>

            <tr>
                <td>
                    <div class="col-md-12">

                        <table class="table">


                            <tr style="background-color: #0E6BB7; color: white;">
                                <td colspan="12">Assigned Role(s)</td>
                            </tr>

                        </table>


                        <table class="table table-striped">

                            <thead>

                            <tr>
                                <th>No</th>
                                <th>RoleName</th>
                            </tr>

                            </thead>

                            <tbody>

                            @foreach($roles as $index=>$role)

                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$role->RoleName}}</td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>

                </td>
            </tr>


            <tr>

                <td>
                    <div class="col-md-12">

                        <a href="{{route('user-edit',$staffId)}}" class="btn btn-info">Edit</a>

                    </div>

                </td>
            </tr>
            </tbody>



        </table>

    </div>

@endsection
