

@extends('layouts.master')

@section('heading-title')

    <h2>Search Details & Actions</h2>
@endsection
@section('content')

    <div class="row">

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
                    <th>First Name</th><td>{{$cdata->ChildFname}}</td>
                </tr>
                <tr>
                    <th>Middle Name</th><td>{{$cdata->ChildMname}}</td>
                </tr>
                <tr>
                    <th>Last Name</th><td>{{$cdata->ChildSurname}}</td>
                </tr>

                <tr>
                    <th>Date Of Birth</th><td>{{$cdata->DoB}}</td>
                </tr>

                <tr>
                    <th>Phone Number</th><td>{{$cdata->PhoneNo}}</td>
                </tr>

                <tr>
                    <th>Entry Number</th><td>{{$cdata->EntryNo}}</td>
                </tr>

                </tbody>

            </table>


            <form action="{{url('birth-certificates/search/exist',$cdata->TrackerID)}}" method="post">

                {{csrf_field()}}

                <input type="hidden" value="{{$cdata->EntryNo}}" name="entryNumberSearch">
                <button type="submit" class="btn btn-primary">Search</button>

            </form>

        </div>
        <div class="col-md-6">
            <table class="table table-striped table-condensed table-custom">

                <tbody>

                <tr>
                    <th>Mother First Name</th><td>{{$cdata->MotherFname}}</td>
                </tr>
                <tr>
                    <th>Mother Middle Name</th><td>{{$cdata->MotherMname}}</td>
                </tr>
                <tr>
                    <th>Mother Last Name</th><td>{{$cdata->MotherSurname}}</td>
                </tr>

                <tr>
                    <th>Father First Name</th><td>{{$cdata->FatherFname}}</td>
                </tr>
                <tr>
                    <th>Father Middle Name</th><td>{{$cdata->FatherMname}}</td>
                </tr>

                <tr>
                    <th>Father Last Name</th><td>{{$cdata->FatherSurname}}</td>
                </tr>



                </tbody>

                {{--                    <a href="{{url()->previous()}}" class="btn btn-info">Back</a>--}}


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
                            <td>{{$result->Sname}}</td>
                            <td>{{$result->DOB}}</td>
                            <td>

                                <a href="{{url('birth-certificates/search/view/1')}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                            </td>
                        </tr>

                        @else

                        <tr>
                            <td colspan="12">No Data Found</td>
                        </tr>
                    @endif


                    </tbody>
                </table>


                <form action="{{url('birth-certificates/search/send-back-result')}}"  method="post">

                    {{csrf_field()}}
                    <div class="form-group">

                        <label for="comment">Comment</label>
                        <textarea class="form-control" rows="2" name="comment" id="comment"></textarea>

                        <input type="hidden" name="trackerId" value="{{$cdata->TrackerID}}">
                        <input type="hidden" name="searchId" value="{{$cdata->SearchID}}">

                        <button type="submit" name="send-back-result" class="btn btn-success">Commit</button>

                    </div>

                </form>
                <a href="{{url()->previous()}}" class="btn btn-info">Back</a>


            </div>
        @endif

    </div>
@endsection
