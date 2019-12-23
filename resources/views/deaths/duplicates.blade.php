
@extends('layouts.master')

@section('heading-title')

    <h2>Duplicate Death Certificates</h2>
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

{{--                @foreach($newBirthRegistrations as $index=>$newBirthRegistration)--}}
{{--                    <tr>--}}
{{--                        <td>{{$index+1}}</td>--}}
{{--                        <td>{{$newBirthRegistration->ApplicationID}}</td>--}}
{{--                        <td>--}}

{{--                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>--}}
{{--                        </td>--}}

{{--                    </tr>--}}

{{--                @endforeach--}}

                </tbody>
            </table>

        </div>

    </div>

@endsection
