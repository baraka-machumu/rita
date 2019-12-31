

@extends('layouts.master')

@section('heading-title')

    <h2>Deceased Details</h2>

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
                    <th>First Name</th><td>{{$ddata->Fname}}</td>
                </tr>
                <tr>
                    <th>Middle Name</th><td>{{$ddata->Mname}}</td>
                </tr>

                <tr>
                    <th>Last Name</th><td>{{$ddata->Surname}}</td>
                </tr>

                <tr>
                    <th>Date Of Birth</th><td>{{$ddata->DOD}}</td>
                </tr>

                <tr>
                    <th>Attachment</th><td>Not Available</td>
                </tr>
                </tbody>

            </table>

            <form method="post" action="{{url('death-certificates/duplicate/search-byentry-number',$ddata->TrackerID)}}">

                {{csrf_field()}}

                <input type="hidden" value="{{$ddata->DeathEntryNo}}" name="entryNo">

                <button type="submit" class="btn btn-primary">Search</button>


                <a href="{{url()->previous()}}" class="btn btn-info">Back</a>

            </form>


            @if($issue_search)

            @endif



        </div>
        <div class="col-md-6">
            <table class="table table-striped table-condensed table-custom">

                <tbody>
                <tr>
                    <th>Informant Phone Number</th><td>{{$ddata->InformantPhone}}</td>
                </tr>

                <tr>
                    <th>Informant Email</th><td>{{$ddata->InformantPhone}}</td>
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
                            <td>{{$result->DOD}}</td>
                            <td>

                                <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#check-death-correct-data-duplicate-cert" ><i class="fa fa-eye"></i></a>

                            </td>
                        </tr>

                    @else

                        <tr>
                            <td colspan="12">No Data Found</td>
                        </tr>
                    @endif


                    </tbody>
                </table>


                <form action="{{url('death-certificates/duplicate/verify',$ddata->TrackerID)}}"  method="post">

                    {{csrf_field()}}

                    <div class="form-group">

                        <label for="comment">Comment</label>
                        <textarea class="form-control" rows="2" name="comment" id="comment"></textarea>

                    </div>

                    <div class="form-group">

                        <button type="submit" name="send-back-result" class="btn btn-success">Verify</button>

                        <a href="{{url('death-certificates/duplicate/return',$ddata->TrackerID)}}" class="btn btn-success">Return</a>

                    </div>

                </form>


            </div>
        @endif


    </div>

    @if($is_check_modal)

        @if(!empty($result->Fname)&&!empty($result->Mname))

            @include('deaths.duplicate_certificate.check_if_data_are_correct_modal')

        @endif
    @endif

@endsection
