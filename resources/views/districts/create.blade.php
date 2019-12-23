
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
                <input type="text" name="name" id="hospital-name" class="form-control">

            </div>
            <div class="form-group">

                <label for="postalCode">Postal Code</label>
                <input type="text" name="postCode" id="postalCode" class="form-control">

            </div>

            <div class="form-group">

                <label for="region">Region</label>
                <select  name="region" id="region" class="form-control region">

                    @foreach($regions as $region)

                        <option value="{{$region['RegionalID']}}">{{$region['RegionalName']}}</option>

                    @endforeach
                </select>

            </div>


        </div>

        <div class="col-md-6">

            <table class="table table-striped table-condensed table-custom">
                <thead>

                <tr>

                    <th>No</th>
                    <th>District Name</th>
                    <th>Action</th>

                </tr>
                </thead>

                <tbody>


                @foreach($districts as $index=>$district)

                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$district->DistrictName}}</td>
                        <td>
                            <a href="{{url('districts/delete')}}" class="btn btn-danger fa fa-trash"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>


        <div class="col-md-12" style="margin-top: 10px;">

            <div class="form-group">

                <button class="btn btn-info" type="submit">Save</button>

                <a href="{{url('districts')}}" class="btn btn-info">Back</a>

            </div>
        </div>


    </form>



@endsection
