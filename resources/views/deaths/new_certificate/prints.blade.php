
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

                @foreach($newBirthprints as $index=>$newBirthprint)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$newBirthprint->FirstName.' '.$newBirthprint->SurName}}</td>
                        <td>{{$newBirthprint->ProcessingOffice}}</td>
                        <td>{{$newBirthprint->NearOffice}}</td>
                        <td style="color: #097689; font-size: 17px;">{{$newBirthprint->StatusName}}</td>

                        <td>{{$newBirthprint->CreatedDate}}</td>

                        <td>

                            <a href="{{url('birth-certificates/new-issue/view',$newBirthprint->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

