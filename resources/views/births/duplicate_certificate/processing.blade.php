
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">
            @if (Auth::user()->IsHQ==1)

                <?php
                $statusId  = 1;
                $btnName = "btn-filter-requests-duplicate";
                ?>
                @include('helpers.filer_form',compact('statusId','btnName'))

            @endif
            <table class="table table-bordered table-striped table-birth-request-duplicate" id="datatable">

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


                @foreach($processing as $index=>$process)
                    <tr>
                        <td>{{$index+1}}</td>

                        <td>{{$process->ChildFname.' '.$process->ChildMname.' '.$process->ChildSurname}}</td>
                        <td>{{$process->OfficeName}}</td>
                        <td>{{$process->NearestOfficeName}}</td>
                        <td>{{$process->ServTypeName}}</td>
                        <td>{{$process->StatusName}}</td>
                        <td>{{$process->ApplicationID}}</td>
                        <td>{{$process->CreatedDate}}</td>

                        <td>

                            <a href="{{url('birth-certificates/duplicate/processing/my-task',$process->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-tasks"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

