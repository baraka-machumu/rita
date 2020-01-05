
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


                @foreach($duplicates as $index=>$duplicate)
                    <tr>
                        <td>{{$index+1}}</td>

                        <td>{{$duplicate->ChildFname.' '.$duplicate->ChildMname.' '.$duplicate->ChildSurname}}</td>
                        <td>{{$duplicate->OfficeName}}</td>
                        <td>{{$duplicate->NearestOfficeName}}</td>
                        <td>{{$duplicate->ServTypeName}}</td>
                        <td>{{$duplicate->StatusName}}</td>
                        <td>{{$duplicate->ApplicationID}}</td>
                        <td>{{$duplicate->CreatedDate}}</td>

                        <td>

                            <a href="{{url('birth-certificates/duplicate/my-task',$duplicate->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-tasks"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

