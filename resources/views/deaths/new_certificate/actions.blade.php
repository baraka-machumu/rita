<div class="row top-margin-tab">

    <div class="col-md-6">

        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Actions</td>
            </tr>

            </tbody>
        </table>


        @if($processing)

            <form method="post" action="{{url('death-certificates/new/approve',$trackerId)}}">

                {{csrf_field()}}

                <button class="btn btn-success" type="submit">Approve</button>
                <a href="#" class="btn btn-info">Reject</a>



                <div class="form-group">
                    <label>Comment</label>
                    <textarea rows="2" name="comment" class="form-control"></textarea>

                </div>
            </form>


            @elseif($verify)

            <form method="post" action="{{url('death-certificates/new/verify',$trackerId)}}">

                {{csrf_field()}}

                <button class="btn btn-success" type="submit">Accept</button>
                <a href="#" class="btn btn-info">Return</a>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea rows="2" name="comment" class="form-control"></textarea>

                </div>
            </form>

        @endif

        @if($issue)

            <form method="post" action="{{url('death-certificates/new/issue',$trackerId)}}">

                {{csrf_field()}}

                <button class="btn btn-success" type="submit">Issue and Print</button>
                <a href="#" class="btn btn-info">Return</a>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea rows="2" name="comment" class="form-control"></textarea>

                </div>
            </form>
        @endif



    </div>


</div>
