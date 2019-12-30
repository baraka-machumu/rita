

<!-- Modal -->
<div class="modal fade" id="check-mother-children" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0E6BB7; color: white;">
                <h5 class="modal-title" id="exampleModalLongTitle"> Children</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">

                    <table class="table table-striped table-condensed table-custom">

                        <thead>

                        <tr><td colspan="12">Total children  <b style="font-style: italic;">{{sizeof($childrenByMotherName)}}</b></td></tr>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Date Of Birth</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($childrenByMotherName as $index=>$child)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$child->Fname}}</td>
                                <td>{{$child->Mname}}</td>
                                <td>{{$child->Surname}}</td>
                                <td>{{$child->DOB}}</td>

                            </tr>
                        @endforeach

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
