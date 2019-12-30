
@extends('layouts.master')


@section('heading-title')

    <h2>View  Certificate To Print</h2>
@endsection
@section('content')

    <div class="row top-margin-tab">

        <div class="col-md-12">

            @include('partials.flash_error')

        </div>

        <div class="col-md-12">

            <button class="btn btn-info">Print</button>

        </div>

{{--        {{$URL_TO_PRINT}}--}}

        <div class="col-md-12">


            <iframe src="{{url($URL_TO_PRINT,$entryNo)}}" style="width:600px; height:500px;" frameborder="0"></iframe>


        </div>

    </div>

    @endsection
