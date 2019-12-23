@extends('layouts.master')


@section('heading-title')

    <h2>New Certificates</h2>


    <input type="hidden" id="tab-selected" value="{{$tab}}">
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

                <li class="nav-item">
                    <a class="nav-link" id="processing-tab" data-toggle="tab" href="#processing" role="tab" aria-controls="processing" aria-selected="false">

                        New Processing Requests

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="processingtask-tab" data-toggle="tab" href="#processingtask" role="tab" aria-controls="processingtask" aria-selected="false">

                       My Processing Tasks

                    </a>
                </li>

{{--                @endif--}}

{{--                @if(App\Manager::can(Config::get('permission.IssueNewCertificate')))--}}

                <li class="nav-item">
                    <a class="nav-link" id="issue-tab" data-toggle="tab" href="#issue" role="tab" aria-controls="issue" aria-selected="false">

                        Issued Certificates

                    </a>
                </li>

{{--                @endif--}}


{{--                @if(App\Manager::can(Config::get('permission.PrintNewCertificate')))--}}

                <li class="nav-item">
                    <a class="nav-link" id="print-tab" data-toggle="tab" href="#print" role="tab" aria-controls="printedCertificate" aria-selected="false">

                        Printed Certificate

                    </a>
                </li>

{{--                    @endif--}}


            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    @include('births.new_certificate.index',compact('newBirthRegPendings'))

                </div>
                <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    @include('births.new_certificate.pending_task')


                </div>

                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processingtask-tab">

                    @include('births.new_certificate.processing_request_task')


                </div>
                <div class="tab-pane fade" id="processingtask" role="tabpanel" aria-labelledby="processingtask-tab">

                    @include('births.new_certificate.processing_task')


                </div>


                <div class="tab-pane fade" id="issue" role="tabpanel" aria-labelledby="issue-tab">

                    @include('births.new_certificate.issue')


                </div>

                <div class="tab-pane fade" id="print" role="tabpanel" aria-labelledby="print-tab">

                    @include('births.new_certificate.prints')


                </div>

            </div>
        </div>


    </div>


@stop
