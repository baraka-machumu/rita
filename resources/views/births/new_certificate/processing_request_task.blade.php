
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">

                @if (Auth::user()->IsHQ==1)

                    <?php
                    $statusId  = 3;
                    $btnName  = 'btn-filter-requests';
                    ?>
                    @include('helpers.filer_form',compact('statusId','btnName'))

                @endif

            <table class="table table-bordered table-striped table-birth-request" id="datatable">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Processing Office</th>
                    <th>Near Office</th>
                    <th>Application Status</th>
                    <th>Application ID</th>
                    <th>Date</th>

                    <th>Action</th>
                </tr>

                </thead>

                <tbody>



                @foreach($newBirthRegProcessingRequests as $index=>$newBirthRegProcessingRequest)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$newBirthRegProcessingRequest->FirstName.' '.$newBirthRegProcessingRequest->SurName}}</td>
                        <td>{{$newBirthRegProcessingRequest->ProcessingOffice}}</td>
                        <td>{{$newBirthRegProcessingRequest->NearOffice}}</td>
                        <td>{{$newBirthRegProcessingRequest->StatusName}}</td>
                        <td>{{$newBirthRegProcessingRequest->ApplicationID}}</td>
                        <td>{{$newBirthRegProcessingRequest->CreatedDate}}</td>

                        <td>

                            <a href="{{url('birth-certificates/new-processing-request',$newBirthRegProcessingRequest->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                        </td>

                    </tr>

                @endforeach



                </tbody>
            </table>

        </div>

    </div>

