
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">
            @if (Auth::user()->IsHQ==1)

                <?php
                $statusId  = 1;
                $btnName = "btn-filter-requests-correction";
                ?>
                @include('helpers.filer_form',compact('statusId','btnName'))

            @endif
            @include('partials.flash_error')
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


                @foreach($processing as $index=>$dublicate)
                    <tr>
                        <td>{{$index+1}}</td>

                        <td>{{$dublicate->ChildFname.' '.$dublicate->ChildMname.' '}}</td>
                        <td>{{$dublicate->ProcessingOffice}}</td>
                        <td>{{$dublicate->NearOffice}}</td>
                        <td>{{$dublicate->ServTypeName}}</td>
                        <td>{{$dublicate->StatusName}}</td>
                        <td>{{$dublicate->ApplicationID}}</td>
                        <td>{{$dublicate->CreatedDate}}</td>

                        <td>

                            <a href="{{url('birth-certificates/correction/processing/my-task',$dublicate->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-tasks"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

