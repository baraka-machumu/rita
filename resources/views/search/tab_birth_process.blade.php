@extends('layouts.master')

@section('heading-title')

    <h2>Search Request</h2>

    <input type="hidden" id="tab-selected" value="{{$tab}}">

@endsection
@section('content')

    <div class="row">

        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">

{{--                    @if(App\Manager::can(Config::get('permission.NCR')))--}}

                        <a   class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">

                            Request

                        </a>
{{--                    @endif--}}

                </li>

{{--                @if(App\Manager::can(Config::get('permission.VerifyCertificateRequest')))--}}

                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">

                        My Task

                    </a>
                </li>

            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    @include('search.process_new_birth_search_service_list')

                </div>

                <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    @include('search.process_my_task_new_birth_search_service_list')

                </div>


            </div>
        </div>

    </div>


@stop
