
<div class="row" style="margin-top: 20px;">

    <div class="col-md-12">

        @if (Auth::user()->IsHQ==1)

            <?php
            $statusId  = 3;
            $btnName = "btn-filter-requests-correction";
            ?>
            @include('helpers.filer_form',compact('statusId','btnName'))

        @endif
        <table class="table table-bordered table-striped table-birth-request-correction" id="datatable">

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

            @foreach($issues as $index=>$iss)
                <tr>
                    <td>{{$index+1}}</td>

                    <td>{{$iss->ChildFname.' '.$iss->ChildMname.' '}}</td>
                    <td>{{$iss->ProcessingOffice}}</td>
                    <td>{{$iss->NearOffice}}</td>
                    <td>{{$iss->ServTypeName}}</td>
                    <td>{{$iss->StatusName}}</td>
                    <td>{{$iss->ApplicationID}}</td>
                    <td>{{$iss->CreatedDate}}</td>

                    <td>

                        <a href="{{url('birth-certificates/correction/view-issue-request',$iss->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                    </td>

                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

</div>

