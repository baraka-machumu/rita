

<!-- Modal -->
<div class="modal fade" id="data-death-error-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0E6BB7; color: white;">
                <h5 class="modal-title" id="exampleModalLongTitle">View Data From Rita Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{url('death-certificates/correction/verify',$ddata->TrackerID)}}" id="form-send-back-result-verify"  method="post">
                    {{csrf_field()}}

                    <input type="hidden" name="correctionFlag" value="100">
                    <input type="hidden" name="applicationId" value="{{$ddata->ApplicationID}}">
                    <input type="hidden" name="frontUserId" value="{{$ddata->FrontUserID}}">

                    <div class="col-md-12">

                        {{--        <form action="{{url('')}}" method="post">--}}


                        <div class="col-md-6" style="margin-bottom: 10px;">


                            <div class="form-group row">
                                <label for="cfirstName" class="col-sm-4 col-form-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cfirstName" class="form-control" id="cfirstName" value="{{$ddata->Fname}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cmiddleName" class="col-sm-4 col-form-label">Middle Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cmiddleName" class="form-control" id="cmiddleName" value="{{$ddata->Mname}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="clastName" class="col-sm-4 col-form-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="clastName" class="form-control" id="clastName" value="{{$ddata->Surname}}">
                                </div>
                            </div>






                        </div>
                        <div class="col-md-6" style="margin-bottom: 15px;">

                            <div class="form-group row">
                                <label for="chospital" class="col-sm-4 col-form-label">Hospital Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="chospital" class="form-control" id="chospital" value="{{$ddata->HospitalID}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-sm-4 col-form-label">Date Of Death</label>
                                <div class="col-sm-8">
                                    <input type="text"   name="dob" class="form-control" id="dob" value="{{$ddata->DOD}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="entryNo" class="col-sm-4 col-form-label">Entry Number</label>
                                <div class="col-sm-8">
                                    <input type="text"  readonly name="entryNo" class="form-control" id="entryNo" value="{{$ddata->DeathEntryNo}}">
                                </div>
                            </div>




                        </div>

                        <div class="form-group">

                            <label for="comment">Comment</label>
                            <textarea class="form-control" rows="2" name="comment" id="comment"></textarea>

                        </div>

                        <div class="form-group">

                            <button type="submit" id="send-back-result-verify" name="send-back-result" class="btn btn-success">Verify</button>

                            {{--                            <a href="{{url('birth-certificates/correction/return',$ddata->TrackerID)}}" class="btn btn-success">Return</a>--}}

                        </div>


                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
