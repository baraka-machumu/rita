

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

    <div class="col-md-6">
        <table class="table table-striped table-condensed table-custom">

            <tbody>

            <tr>
                <th>First Name</th><td>{{$vdata->Fname}}</td>
            </tr>
            <tr>
                <th>Middle Name</th><td>{{$vdata->Mname}}</td>
            </tr>
            <tr>
                <th>Last Name</th><td>{{$vdata->Surname}}</td>
            </tr>

            <tr>
                <th>Date Of Birth</th><td>{{$vdata->DOD}}</td>
            </tr>

            <tr>
                <th>Attachment</th><td>

                    @if($attachment)
                    {{$attachment->AttachmentPath}}

                        @else

                        <span style="color: red;">
                            No Attachment
                        </span>
                        @endif

                </td>
            </tr>
            </tbody>

        </table>

        <form method="post" action="{{url('death-certificates/verify/search-byentry-number',$vdata->TrackerID)}}">

            {{csrf_field()}}

            <input type="hidden" value="{{$vdata->DeathEntryNo}}" name="entryNo">

            <button type="submit" class="btn btn-primary">Search</button>

            <a href="{{url('death-certificates/verify/return',$vdata->TrackerID)}}" class="btn btn-success">Return</a>

            <a href="{{url()->previous()}}" class="btn btn-info">Back</a>

        </form>



    </div>
    <div class="col-md-6">
        <table class="table table-striped table-condensed table-custom">

            <tbody>
            <tr>
                <th>Phone Number</th><td>{{$vdata->InformantPhone}}</td>
            </tr>


            <tr>
                <th>Email</th><td>{{$vdata->InformantEmail}}</td>
            </tr>


            <tr>
                <th>Entry Number</th><td>{{$vdata->DeathEntryNo}}</td>
            </tr>
            </tbody>



        </table>

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

{{--                            <a href="{{url('birth-certificates/search/view/1')}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>--}}

                        </td>
                    </tr>

                @else

                    <tr>
                        <td colspan="12">No Data Found</td>
                    </tr>
                @endif


                </tbody>
            </table>


            <form action="{{url('birth-certificates/verify/response')}}"  method="post">

                {{csrf_field()}}

                <div class="form-group">

                    <label for="comment">Comment</label>
                    <textarea class="form-control" rows="2" name="comment" id="comment"></textarea>


                    <input type="hidden" name="trackerId" value="{{$vdata->TrackerID}}">
{{--                    <input type="hidden" name="verificationId" value="{{$vdata->VerificationID}}">--}}

                </div>
                <div class="form-group">

                    <input type="file" name="file" class="form-control">


                </div>

                <div class="form-group">

                    <button type="submit" name="send-back-result" class="btn btn-success">Commit</button>


                </div>
            </form>


        </div>
    @endif


    </div>

@endsection
