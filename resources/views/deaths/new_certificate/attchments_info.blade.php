<div class="row top-margin-tab">




    <div class="col-md-12">
        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Attachments</td>
            </tr>

            </tbody>


        </table>

    </div>

    <div class="col-md-6">




        <table class="table table-striped">


            <thead>
            <tr>

                <th>No</th>
                <th>Attachment Name</th>

                <th>Actions</th>

            </tr>
            </thead>

            <tbody>

            @foreach($attachments as $index=>$attachment)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$attachment->AttachementTypeName}}</td>

                <td>

                    <a href="#" class="btn btn-info"><i class="fa fa-eye"></i></a>

                </td>

            </tr>

                @endforeach


            </tbody>

        </table>


    </div>



</div>
