
    <div class="row" style="margin-top: 20px;">

        <div class="col-md-12">

            @if (Auth::user()->IsHQ==1)

                <?php
                $statusId  = 10;
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

                @foreach($newBirthRegissues as $index=>$newBirthRegissue)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$newBirthRegissue->FirstName.' '.$newBirthRegissue->SurName}}</td>
                        <td>{{$newBirthRegissue->ProcessingOffice}}</td>
                        <td>{{$newBirthRegissue->NearOffice}}</td>
                        <td style="color: #097689; font-size: 17px;">{{$newBirthRegissue->StatusName}}</td>

                        <td>{{$newBirthRegissue->CreatedDate}}</td>

                        <td>


                            <a href="{{url('death-certificates/new-issue/view',$newBirthRegissue->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>


                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

