
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">

            <table class="table table-bordered table-striped table-search" id="datatable">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Processing Office</th>
                    <th>Near Office</th>
                    <th>Application Status</th>

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

