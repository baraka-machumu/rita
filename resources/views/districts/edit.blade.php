
@extends('layouts.master')

@section('heading-title')

    <h2>New District</h2>
@endsection

@section('content')

    <div class="row">


        {{csrf_field()}}
        <div class="col-md-12">

            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p>
                @endif
            @endforeach

        </div>
    </div>

    <form method="post" action="{{url('districts/store')}}">

        {{csrf_field()}}
        <div class="col-md-6">

            <div class="form-group">

                <label for="hospital-name">District Name</label>
                <input type="text" name="name" value="{{$district->DistrictName}}" id="hospital-name" class="form-control">

            </div>
            <div class="form-group">

                <label for="postalCode">Postal Code</label>
                <input type="text" name="postCode" value="{{$district->PostCode}}"  id="postalCode" class="form-control">

            </div>

            <div class="form-group">

                <label for="region">Region</label>
                <select  name="region" id="region" class="form-control region">


                    @foreach($regions as $region)

                        <option value="{{$region['RegionalID']}}"


                        @if($region['RegionalID']===$districtId)

                            selected
                                @endif

                          >{{$region['RegionalName']}}</option>

                    @endforeach
                </select>

            </div>


        </div>


        <div class="col-md-12" style="margin-top: 10px;">

            <div class="form-group">

                <button class="btn btn-info" type="submit">Update</button>

                <a href="{{url('districts')}}" class="btn btn-primary">Back</a>

            </div>
        </div>


    </form>



@endsection
