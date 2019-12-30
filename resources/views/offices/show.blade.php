
@extends('layouts.master')



@section('heading-title')

    <h2>Roles</h2>
@endsection

@section('content')

    <div class="row">


        <div class="col-md-12">

            <table>
                <tbody>

                <tr>
                    <th>Username</th><td>{{$staff->Username}}</td>
                </tr>

                </tbody>

            </table>

        </div>


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

                @foreach($roles as $role)

                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$roles->RoleName}}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

@endsection
