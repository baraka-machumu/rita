

<!-- Modal -->
<div class="modal fade" id="check-correct-data-duplicate-cert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0E6BB7; color: white;">
                <h5 class="modal-title" id="exampleModalLongTitle">View Data From Rita Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="col-md-6">
                    <table class="table table-striped table-condensed table-custom">

                        <tbody>

                        <tr>
                            <th>First Name</th><td>{{$result->Fname}}</td>
                        </tr>

                        <tr>
                            <th>Middle Name</th><td>{{$result->Mname}}</td>
                        </tr>

                        <tr>
                            <th>SurName</th><td>{{$result->Surname}}</td>
                        </tr>

                        <tr>
                            <th>Date Of Birth</th><td>{{$result->DOB}}</td>
                        </tr>

                        <tr>
                            <th>NationlIty</th><td>{{$result->ChildNationalityID}}</td>
                        </tr>
                        <tr>
                            <th>Physical Address</th><td>{{$result->PhysicalAddress}}</td>
                        </tr>

                        <tr>
                            <th>Sex</th><td>{{$result->SexName}}</td>
                        </tr>

                        <tr>
                            <th>Entry Number </th><td>{{$result->EntryNo}}</td>
                        </tr>

                        </tbody>

                    </table>

                </div>


                <div class="col-md-6">
                    <table class="table table-striped table-condensed table-custom">

                        <tbody>


                        <tr>
                            <th>Mother Full Name</th><td>{{$result->MotherFullName}}</td>
                        </tr>

                        <tr>
{{--                            <th>Mother Nationality</th><td>{{$result->MotherNationalityID}}</td>--}}
                        </tr>

                        <tr>
                            <th>Father Full Name</th><td>{{$result->FatherFullName}}</td>
                        </tr>

                        <tr>
{{--                            <th>Father Nationality</th><td>{{$result->FatherNationalityID}}</td>--}}
                        </tr>

                        </tbody>

                    </table>

                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
