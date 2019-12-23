<div class="row top-margin-tab">

    <div class="col-md-12">


        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Father Information</td>
            </tr>

            </tbody>


        </table>



    </div>



    <div class="col-md-6">
        <table class="table table-striped">

            <tbody>

            <tr>
                <th>Full Name</th><td>{{$fatherInfo->FirstName.' '.$fatherInfo->MiddleName.' '.$fatherInfo->FirstName}}</td>
            </tr>

            <tr>
                <th>Other Name</th><td>{{$fatherInfo->OtherName}}</td>
            </tr>

            <tr>
                <th>Date Of Birth</th><td>{{$fatherInfo->DOB}}</td>
            </tr>

            <tr>
                <th>Sex</th><td>{{$fatherInfo->SexName}}</td>
            </tr>

            <tr>
                <th>Phone Number</th><td>{{$fatherInfo->PhoneNo}}</td>
            </tr>

            <tr>
                <th>Country Name</th><td>{{$fatherInfo->CountryName}}</td>
            </tr>


            <tr>
                <th>Street</th><td>{{$fatherInfo->Street}}</td>
            </tr>


            </tbody>

        </table>


    </div>
    <div class="col-md-6">
        <table class="table table-striped">

            <tbody>

            <tr>
                <th>Street</th><td>{{$fatherInfo->Street}}</td>
            </tr>


            <tr>
                <th>Physical Address</th><td>{{$fatherInfo->PhysicalAddress}}</td>
            </tr>


            <tr>
                <th>Ident Number</th><td>{{$fatherInfo->IdentNo}}</td>
            </tr>


            <tr>
                <th>NIN</th><td>{{$fatherInfo->NIN}}</td>
            </tr>


            <tr>
                <th>Processing Office</th><td>{{$fatherInfo->ProcessingOffice}}</td>
            </tr>


            <tr>
                <th>Near Office</th><td>{{$fatherInfo->NearOffice}}</td>
            </tr>


            <tr>
                <th>Date Submitted</th><td>{{$fatherInfo->CreatedDate}}</td>
            </tr>
            <tr>
                <th>Occupation</th><td>{{$fatherInfo->Occupation}}</td>
            </tr>

            </tbody>

        </table>


    </div>
</div>
