@extends('layouts.master')


@section('heading-title')

    <h2>Process Duplicate</h2>

    <input type="hidden" value="{{$tab}}" id="tab-verify-selected">

@endsection
@section('content')


    <div class="row">


        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">

{{--                    @if(App\Manager::can(Config::get('permission.NCR')))--}}

                        <a   class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">

                            New Requests

                        </a>
{{--                    @endif--}}


                </li>

{{--                @if(App\Manager::can(Config::get('permission.VerifyCertificateRequest')))--}}

                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">

                        My Tasks

                    </a>
                </li>


            </ul>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    @include('births.duplicate_certificate.processing')

                </div>
                <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">


                    @include('births.duplicate_certificate.processing_my_task')

                </div>



            </div>
        </div>


    </div>


@stop
