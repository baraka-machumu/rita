

@extends('layouts.master')

@section('heading-title')

    <h2>Search Details & Actions</h2>

@endsection
@section('content')

<div class="row">

    <div class="col-md-12">

        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}" style="color: white;">{{ Session::get('alert-' . $msg) }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p>
            @endif
        @endforeach

    </div>
    <div class="col-md-12">


        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Informations</td>
            </tr>

            </tbody>

        </table>

    </div>

    <div class="col-md-6">
        <table class="table table-striped table-condensed table-custom">

            <tbody>

            <tr>
                <th>First Name</th><td>{{$vdata->ChildFname}}</td>
            </tr>
            <tr>
                <th>Middle Name</th><td>{{$vdata->ChildMname}}</td>
            </tr>
            <tr>
                <th>Last Name</th><td>{{$vdata->ChildLname}}</td>
            </tr>

            <tr>
                <th>Date Of Birth</th><td>{{$vdata->DOB}}</td>
            </tr>


            </tbody>

        </table>

        <form method="post" action="{{url('birth-certificates/correction/verify/search-byentry-number')}}">

            {{csrf_field()}}

            <input type="hidden" value="{{$vdata->EntryNo}}" name="entryNo">

            <button type="submit" class="btn btn-primary">Search</button>

            <a href="{{url('birth-certificates/correction/verify/return',$vdata->TrackerID)}}" class="btn btn-success">Return</a>

            <a href="{{url()->previous()}}" class="btn btn-info">Back</a>

        </form>



    </div>
    <div class="col-md-6">
        <table class="table table-striped table-condensed table-custom">

            <tbody>
            <tr>
                <th>Phone Number</th><td>{{$vdata->PhoneNo}}</td>
            </tr>

            <tr>
                <th>Mother First Name</th><td>{{$vdata->MotherFname}}</td>
            </tr>


            <tr>
                <th>Mother  SurName</th><td>{{$vdata->MotherSurname}}</td>
            </tr>

            <tr>
                <th>Entry Number </th><td>{{$vdata->EntryNo}}</td>
            </tr>



            </tbody>



        </table>

    </div>



    </div>

@endsection
