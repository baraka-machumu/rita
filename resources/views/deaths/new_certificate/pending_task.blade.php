
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">


            @include('partials.flash_error')

            <table class="table table-bordered table-striped table-death-request" id="datatable">

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



                @foreach($newBirthRegPendings as $index=>$newBirthRegPending)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$newBirthRegPending->FirstName.' '.$newBirthRegPending->SurName}}</td>
                        <td>{{$newBirthRegPending->ProcessingOffice}}</td>
                        <td>{{$newBirthRegPending->NearOffice}}</td>
                        <td>{{$newBirthRegPending->StatusName}}</td>

                        <td>{{$newBirthRegPending->CreatedDate}}</td>

                        <td>

                            <a href="{{url('death-certificates/new/view',$newBirthRegPending->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>

                @endforeach



                </tbody>
            </table>

        </div>

    </div>

