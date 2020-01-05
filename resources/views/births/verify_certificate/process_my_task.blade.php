
<div class="row" style="margin-top: 20px;">

    <div class="col-md-12">

        @include('partials.flash_error')
        <table class="table table-bordered table-striped table-search" id="datatable">

            <thead>

            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Processing Office</th>
                <th>Service Type</th>
                <th>Application Status</th>

                <th>Date</th>

                <th>Action</th>
            </tr>

            </thead>

            <tbody>

            @foreach($myTaskverifications as $index=>$verification)
                <tr>
                    <td>{{$index+1}}</td>

                    <td>{{$verification->ChildFname.' '.$verification->ChildMname.' '.$verification->ChildLname}}</td>
                    <td>{{$verification->OfficeName}}</td>
                    <td>Verification Service</td>
                    <td>{{$verification->StatusName}}</td>
                    <td>{{$verification->CreatedDate}}</td>

                    <td>

                        <a href="{{url('birth-certificates/verify/view-processing-request',$verification->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                    </td>

                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

</div>

