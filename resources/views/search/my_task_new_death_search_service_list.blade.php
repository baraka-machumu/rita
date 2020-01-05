
    <div class="row top-margin-tab">

        <div class="col-md-12">
            @if (Auth::user()->IsHQ==1)

                <?php
                $statusId  = 1;
                $btnName = "btn-filter-death-requests-search";
                ?>
                @include('helpers.filer_form',compact('statusId','btnName'))

            @endif
            @include('partials.flash_error')

            <table class="table table-striped">

                <tbody>

                <tr style="background-color: #0E6BB7; color: white;">
                    <td colspan="12">Data</td>
                </tr>

                </tbody>

            </table>

        </div>

        <div class="col-md-12">


            <table class="table table-bordered  table-death-request-search" id="datatable">

                <thead>

                <tr>

                    <th>No</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Date Of Birth</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>


                @foreach($myTaskcdata as $index=>$result)

                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$result->Fname}}</td>
                        <td>{{$result->Mname}}</td>
                        <td>{{$result->Surname}}</td>
                        <td>{{$result->DOD}}</td>
                        <td>

                            <a href="{{url('death-certificates/search/view',$result->TrackerID)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <a href="{{url()->previous()}}" class="btn btn-info">Back</a>


        </div>

    </div>
