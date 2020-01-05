
<from>


    <div class="col-md-3" style="margin-bottom: 10px">

        <div class="forn-group">

            <select class="form-control region region-filter">
                <option disabled>--select Region---</option>

                @foreach($regions as $region)

                    <option value="{{$region['RegionalID']}}">{{$region['RegionalName']}}</option>

                @endforeach
            </select>

        </div>
    </div>

    <div class="col-md-3" style="margin-bottom: 10px;">
        <div class="forn-group">

            <select class="form-control  district district-filer">

            </select>

        </div>
    </div>

{{--    100 means new birth request--}}
    <input type="hidden" name="request" class="new-birth-request-status" value="{{$statusId}}">

    <div class="col-md-2">

        <button class="btn btn-info btn-filter-requests-old-to-new">Get Data</button>

    </div>


</from>
