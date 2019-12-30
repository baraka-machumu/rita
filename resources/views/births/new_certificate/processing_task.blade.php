
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">

            @include('partials.flash_error')
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

                @foreach($newBirthRegProcessingTasks as $index=>$newBirthRegProcessingTask)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$newBirthRegProcessingTask->FirstName.' '.$newBirthRegProcessingTask->SurName}}</td>
                        <td>{{$newBirthRegProcessingTask->ProcessingOffice}}</td>
                        <td>{{$newBirthRegProcessingTask->NearOffice}}</td>
                        <td>{{$newBirthRegProcessingTask->StatusName}}</td>

                        <td>{{$newBirthRegProcessingTask->CreatedDate}}</td>

                        <td>

                            <a href="{{url('birth-certificates/new-processing-request/view',$newBirthRegProcessingTask->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

