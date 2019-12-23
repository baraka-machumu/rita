
@extends('layouts.master')

@section('heading-title')

    <h2>Birth Certificates</h2>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Processing Office</th>
                    <th>Service Type</th>
                    <th>Application Status</th>
                    <th>Payment Status</th>
                    <th>Date</th>

                    <th>Action</th>
                </tr>

                </thead>

                <tbody>

                <tr>

                    <td>1</td>
                    <td>baraka machumu</td>
                    <td>temeke</td>
                    <td>New Registration</td>
                    <td>On Progress</td>
                    <td>Paid</td>
                    <td>2019-12--5</td>
                    <td>
                        <a href="{{url('birth-certificates/view',1002)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                    </td>

                </tr>
{{--                @foreach($newBirthRegistrations as $index=>$newBirthRegistration)--}}
{{--                    <tr>--}}
{{--                        <td>{{$index+1}}</td>--}}
{{--                        <td>{{$newBirthRegistration->ApplicationID}}</td>--}}
{{--                        <td>--}}

{{--                            <a href="{{$newBirthRegistration->ApplicationID}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>--}}
{{--                        </td>--}}

{{--                    </tr>--}}

{{--                @endforeach--}}

                </tbody>
            </table>

        </div>

    </div>

@endsection
