
<div class="row" style="margin-top: 20px;">

    <div class="col-md-12">
        @if (Auth::user()->IsHQ==1)

            <?php
            $statusId  = 3;
            $btnName = "btn-filter-requests-old-to-new";
            ?>
            @include('helpers.filer_form',compact('statusId','btnName'))

        @endif
        <table class="table table-bordered table-striped table-birth-request-old-to-new" id="datatable">

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

            @foreach($issues as $index=>$myTaskDuplicate)
                <tr>
                    <td>{{$index+1}}</td>

                    <td>{{$myTaskDuplicate->ChildFname.' '.$myTaskDuplicate->ChildMname.' '.$myTaskDuplicate->ChildSurname}}</td>
                    <td>{{$myTaskDuplicate->OfficeName}}</td>
                    <td>{{$myTaskDuplicate->ServTypeName}}</td>
                    <td>{{$myTaskDuplicate->StatusName}}</td>
                    <td>{{$myTaskDuplicate->CreatedDate}}</td>

                    <td>

                        <a href="{{url('birth-certificates/replace/view-issue-request',$myTaskDuplicate->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                    </td>

                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

</div>

