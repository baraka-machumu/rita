
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

            @foreach($myTaskDuplicates as $index=>$myTaskDuplicate)
                <tr>
                    <td>{{$index+1}}</td>

                    <td>{{$myTaskDuplicate->ChildFname.' '.$myTaskDuplicate->ChildMname.' '.$myTaskDuplicate->ChildSurname}}</td>
                    <td>{{$myTaskDuplicate->OfficeName}}</td>
                    <td>{{$myTaskDuplicate->ServTypeName}}</td>
                    <td>{{$myTaskDuplicate->StatusName}}</td>
                    <td>{{$myTaskDuplicate->CreatedDate}}</td>

                    <td>

                        <a href="{{url('birth-certificates/duplicate/view-request',$myTaskDuplicate->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                    </td>

                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

</div>

