
@extends('layouts.master')

@section('heading-title')

    <h2>New Hospital</h2>
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

    <form method="post" action="{{url('hospitals/store')}}">

        {{csrf_field()}}
        <div class="col-md-6">

            <div class="form-group">

                <label for="hospital-name">Hospital Name</label>
                <input type="text" name="name" id="hospital-name" class="form-control">

            </div>
            <div class="form-group">

                <label for="region">Region</label>
                <select  name="region" id="region" class="form-control region">

                    @foreach($regions as $region)

                        <option value="{{$region->RegionalID}}">{{$region->RegionalName}}</option>

                    @endforeach
                </select>

            </div>
            <div class="form-group">

                <label for="district-id">District</label>
                <select  name="district" id="district-id" class="form-control district">

                </select>
            </div>


        </div>



        <div class="col-md-12" style="margin-top: 10px;">

            <div class="form-group">

                <button class="btn btn-info" type="submit">Save</button>

            </div>
        </div>


    </form>



@endsection
