

@extends('layouts.master')

@section('heading-title')

    <h2>Informant Details</h2>


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

{{--    <form action="{{url('birth-certificates/correction/verify',$ddata->TrackerID)}}" id="form-send-back-result-verify"  method="post">--}}
{{--        {{csrf_field()}}--}}

{{--        <input type="hidden" name="correctionFlag" value="100">--}}
{{--        <input type="hidden" name="applicationId" value="{{$ddata->ApplicationID}}">--}}
{{--        <input type="text" name="trackerId" value="{{$ddata->TrackerID}}">--}}
    <div class="col-md-12">

        {{--        <form action="{{url('')}}" method="post">--}}


        <div class="col-md-6" style="margin-bottom: 10px;">


            <div class="form-group row">
                <label for="cfirstName" class="col-sm-4 col-form-label">First Name</label>
                <div class="col-sm-8">
                    <input type="text" name="cfirstName" class="form-control" id="cfirstName" value="{{$ddata->ChildFname}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="cmiddleName" class="col-sm-4 col-form-label">Middle Name</label>
                <div class="col-sm-8">
                    <input type="text" name="cmiddleName" class="form-control" id="cmiddleName" value="{{$ddata->ChildMname}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="clastName" class="col-sm-4 col-form-label">Last Name</label>
                <div class="col-sm-8">
                    <input type="text" name="clastName" class="form-control" id="clastName" value="{{$ddata->ChildSurname}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="chospital" class="col-sm-4 col-form-label">Hospital Name</label>
                <div class="col-sm-8">
                    <input type="text" name="chospital" class="form-control" id="chospital" value="{{$ddata->ChildSurname}}">
                </div>
            </div>




            <div class="form-group row">
                <label for="mfirstName" class="col-sm-4 col-form-label">Mother First Name</label>
                <div class="col-sm-8">
                    <input type="text" name="mFirstName" class="form-control" id="mfirstName" value="{{$ddata->DOB}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="mMiddleName" class="col-sm-4 col-form-label">Mother Middle Name</label>
                <div class="col-sm-8">
                    <input type="text" name="mMiddleName" class="form-control" id="mMiddleName" value="{{$ddata->DOB}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="dob" class="col-sm-4 col-form-label">Date Of Birth</label>
                <div class="col-sm-8">
                    <input type="text"   name="dob" class="form-control" id="dob" value="{{$ddata->DOB}}">
                </div>
            </div>


        </div>
        <div class="col-md-6" style="margin-bottom: 15px;">


            <div class="form-group row">
                <label for="mLastName" class="col-sm-4 col-form-label">Mother Last Name</label>
                <div class="col-sm-8">
                    <input type="text" name="mLastName" class="form-control" id="mLastName" value="{{$ddata->ChildFname}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="mcountryBirth" class="col-sm-4 col-form-label">Mother Country Of Birth </label>
                <div class="col-sm-8">
                    <input type="text" name="mcountryBirth" class="form-control" id="mcountryBirth" value="{{$ddata->DOB}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="ffirstName" class="col-sm-4 col-form-label">Father First Name</label>
                <div class="col-sm-8">
                    <input type="text" name="ffirstName" class="form-control" id="ffirstName" value="{{$ddata->ChildMname}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="fMiddleName" class="col-sm-4 col-form-label">Father Middle Name</label>
                <div class="col-sm-8">
                    <input type="text" name="fMiddleName" class="form-control" id="fMiddleName" value="{{$ddata->ChildSurname}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="fLastName" class="col-sm-4 col-form-label">Father Last Name</label>
                <div class="col-sm-8">
                    <input type="text" name="fLastName" class="form-control" id="fLastName" value="{{$ddata->ChildSurname}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="fcountryBirth" class="col-sm-4 col-form-label">Father Country Of Birth </label>
                <div class="col-sm-8">
                    <input type="text" name="fcountryBirth" class="form-control" id="fcountryBirth" value="{{$ddata->DOB}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="entryNo" class="col-sm-4 col-form-label">Entry Number</label>
                <div class="col-sm-8">
                    <input type="text"  readonly name="entryNo" class="form-control" id="entryNo" value="{{$ddata->EntryNo}}">
                </div>
            </div>

        </div>


    </div>


    <div class="col-md-12">

        <form method="post" action="{{url('birth-certificates/correction/search-byentry-number',$ddata->TrackerID)}}">

            {{csrf_field()}}

            <input type="hidden" value="{{$ddata->EntryNo}}" name="entryNo">

            <button type="submit" class="btn btn-primary">Search</button>


            <a href="{{url()->previous()}}" class="btn btn-info">Back</a>

        </form>

    </div>
    @if($is_result)
        <div class="col-md-12">

            <table class="table table-bordered table-striped">

                <thead>

                <tr>

                    <th>No</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Date Of Birth</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>


                @if($result)
                    <tr>
                        <td>1</td>
                        <td>{{$result->Fname}}</td>
                        <td>{{$result->Mname}}</td>
                        <td>{{$result->Surname}}</td>
                        <td>{{$result->DOB}}</td>
                        <td>

                            <a href="#" data-toggle="modal" data-target="#data-error-modal" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                        </td>
                    </tr>

                @else

                    <tr>
                        <td colspan="12">No Data Found</td>
                    </tr>
                @endif


                </tbody>
            </table>


            <form method="post" action="{{url('birth-certificates/correction/return',$ddata->TrackerID)}}">


                {{csrf_field()}}
                <div class="form-group">

                    <label for="comment">Comment</label>
                    <textarea class="form-control" rows="2" name="comment" id="comment"></textarea>

                </div>

                <div class="form-group">

{{--                    <button type="submit" id="send-back-result-verify" name="send-back-result" class="btn btn-success">Verify</button>--}}

                        <button  type="submit" class="btn btn-success">Return</button>


                </div>
            </form>


        </div>
    @endif

{{--    </form>--}}

    </div>

    @include('births.change_certificate_details.data_error_modal')

@endsection
