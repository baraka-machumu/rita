
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">
            @if (Auth::user()->IsHQ==1)

                <?php
                $statusId  = 1;
                $btnName = "btn-filter-death-requests";
                ?>
                @include('helpers.filer_form',compact('statusId','btnName'))

            @endif
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



                @foreach($newBirthRegistrations as $index=>$newBirthRegistration)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$newBirthRegistration->FirstName.' '.$newBirthRegistration->SurName}}</td>
                        <td>{{$newBirthRegistration->ProcessingOffice}}</td>
                        <td>{{$newBirthRegistration->NearOffice}}</td>
                        <td>{{$newBirthRegistration->StatusName}}</td>

                        <td>{{$newBirthRegistration->CreatedDate}}</td>

                        <td>

                            <a href="{{url('death-certificates/new/pending',$newBirthRegistration->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-tasks"></i></a>
                        </td>

                    </tr>

                @endforeach



                </tbody>
            </table>

        </div>

    </div>

