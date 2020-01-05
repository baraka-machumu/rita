
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">
            @if (Auth::user()->IsHQ==1)

                <?php
                $statusId  = 1;
                $btnName = "btn-filter-requests-verification";
                ?>
                @include('helpers.filer_form',compact('statusId','btnName'))

            @endif
            <table class="table table-bordered table-striped table-birth-request-verification" id="datatable">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Processing Office</th>
                    <th>Nearest Office</th>
                    <th>Service Type</th>
                    <th>Application Status</th>
                    <th>Application ID</th>
                    <th>Date</th>

                    <th>Action</th>
                </tr>

                </thead>

                <tbody>


                @foreach($verifications as $index=>$verification)
                    <tr>
                        <td>{{$index+1}}</td>

                        <td>{{$verification->ChildFname.' '.$verification->ChildMname.' '.$verification->ChildLname}}</td>
                        <td>{{$verification->OfficeName}}</td>
                        <td>{{$verification->NearestOffice}}</td>
                        <td>Verification Service</td>
                        <td>{{$verification->StatusName}}</td>
                        <td>{{$verification->ApplicationID}}</td>
                        <td>{{$verification->CreatedDate}}</td>

                        <td>

                            <a href="{{url('birth-certificates/verify/my-task',$verification->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-tasks"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

