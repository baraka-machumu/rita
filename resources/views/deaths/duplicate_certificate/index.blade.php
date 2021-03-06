
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">

            @if (Auth::user()->IsHQ==1)

                <?php
                $statusId  = 1;
                $btnName = "btn-filter-death-requests-duplicate";
                ?>
                @include('helpers.filer_form',compact('statusId','btnName'))

            @endif
            <table class="table table-bordered table-striped table-death-request-duplicate" id="datatable">

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


                @foreach($dublicates as $index=>$dublicate)
                    <tr>
                        <td>{{$index+1}}</td>

                        <td>{{$dublicate->Fname.' '.$dublicate->Mname.' '.$dublicate->Surname}}</td>
                        <td>{{$dublicate->OfficeName}}</td>
                        <td>{{$dublicate->ServTypeName}}</td>
                        <td>{{$dublicate->StatusName}}</td>
                        <td>{{$dublicate->CreatedDate}}</td>

                        <td>

                            <a href="{{url('death-certificates/duplicate/my-task',$dublicate->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-tasks"></i></a>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

