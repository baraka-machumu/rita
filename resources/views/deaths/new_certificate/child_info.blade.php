<div class="row top-margin-tab">

    <div class="col-md-12">


        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Personal Information</td>
            </tr>

            </tbody>


        </table>



    </div>



    <div class="col-md-6">
        <table class="table table-striped">

            <tbody>

            <tr>
                <th>Full Name</th><td>{{$childInfo->FirstName.' '.$childInfo->FirstName.' '.$childInfo->FirstName}}</td>
            </tr>

            <tr>
                <th>Other Name</th><td>{{$childInfo->OtherName}}</td>
            </tr>

            <tr>
                <th>Date Of Birth</th><td>{{$childInfo->DOB}}</td>
            </tr>

            <tr>
                <th>Sex</th><td>{{$childInfo->SexName}}</td>
            </tr>

            <tr>
                <th>Phone Number</th><td>{{$childInfo->PhoneNo}}</td>
            </tr>

            <tr>
                <th>Country Name</th><td>{{$childInfo->CountryName}}</td>
            </tr>


            <tr>
                <th>Street</th><td>{{$childInfo->Street}}</td>
            </tr>


            </tbody>

        </table>
        <a href="{{url()->previous()}}" class="btn btn-info">Back</a>


    </div>
    <div class="col-md-6">
        <table class="table table-striped">

            <tbody>

            <tr>
                <th>Street</th><td>{{$childInfo->Street}}</td>
            </tr>


            <tr>
                <th>Physical Address</th><td>{{$childInfo->PhysicalAddress}}</td>
            </tr>


            <tr>
                <th>Ident Number</th><td>{{$childInfo->IdentNo}}</td>
            </tr>


            <tr>
                <th>NIN</th><td>{{$childInfo->NIN}}</td>
            </tr>


            <tr>
                <th>Processing Office</th><td>{{$childInfo->ProcessingOffice}}</td>
            </tr>


            <tr>
                <th>Near Office</th><td>{{$childInfo->NearOffice}}</td>
            </tr>


            <tr>
                <th>Date Submitted</th><td>{{$childInfo->CreatedDate}}</td>
            </tr>
            <tr>
                <th>Occupation</th><td>{{$childInfo->Occupation}}</td>
            </tr>

            </tbody>

        </table>



    </div>
</div>
