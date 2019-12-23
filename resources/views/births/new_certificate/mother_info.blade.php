<div class="row top-margin-tab">

    <div class="col-md-12">


        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Mother Information</td>
            </tr>

            </tbody>


        </table>



    </div>



    <div class="col-md-6">
        <table class="table table-striped">

            <tbody>

            <tr>
                <th>Full Name</th><td>{{$motherInfo->FirstName.' '.$motherInfo->MiddleName.' '.$motherInfo->FirstName}}</td>
            </tr>

            <tr>
                <th>Other Name</th><td>{{$motherInfo->OtherName}}</td>
            </tr>

            <tr>
                <th>Date Of Birth</th><td>{{$motherInfo->DOB}}</td>
            </tr>

            <tr>
                <th>Sex</th><td>{{$motherInfo->SexName}}</td>
            </tr>

            <tr>
                <th>Phone Number</th><td>{{$motherInfo->PhoneNo}}</td>
            </tr>

            <tr>
                <th>Country Name</th><td>{{$motherInfo->CountryName}}</td>
            </tr>


            <tr>
                <th>Street</th><td>{{$motherInfo->Street}}</td>
            </tr>


            </tbody>

        </table>


    </div>
    <div class="col-md-6">
        <table class="table table-striped">

            <tbody>

            <tr>
                <th>Street</th><td>{{$motherInfo->Street}}</td>
            </tr>


            <tr>
                <th>Physical Address</th><td>{{$motherInfo->PhysicalAddress}}</td>
            </tr>


            <tr>
                <th>Ident Number</th><td>{{$motherInfo->IdentNo}}</td>
            </tr>


            <tr>
                <th>NIN</th><td>{{$motherInfo->NIN}}</td>
            </tr>


            <tr>
                <th>Processing Office</th><td>{{$motherInfo->ProcessingOffice}}</td>
            </tr>


            <tr>
                <th>Near Office</th><td>{{$motherInfo->NearOffice}}</td>
            </tr>


            <tr>
                <th>Date Submitted</th><td>{{$motherInfo->CreatedDate}}</td>
            </tr>
            <tr>
                <th>Occupation</th><td>{{$motherInfo->Occupation}}</td>
            </tr>

            </tbody>

        </table>


    </div>
</div>
