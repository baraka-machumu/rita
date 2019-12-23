@extends('layouts.master')


@section('heading-title')

    <h2>New Certificates</h2>
{{--    <input type="hidden" id="tab-selected" value="{{$tab}}">--}}
@endsection
@section('content')


    <div class="row">


        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">


                        <a   class="nav-link" id="child-tab" data-toggle="tab" href="#child" role="tab" aria-controls="child" aria-selected="true">

                            Child Info

                        </a>


                </li>


                <li class="nav-item">
                    <a class="nav-link" id="mother-tab" data-toggle="tab" href="#mother" role="tab" aria-controls="mother" aria-selected="false">

                        Mother Info

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="father-tab" data-toggle="tab" href="#father" role="tab" aria-controls="father" aria-selected="false">

                        Father Info

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">

                    Attachments
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" id="actions-tab" data-toggle="tab" href="#actions" role="tab" aria-controls="actions" aria-selected="false">

                        Actions

                    </a>
                </li>





            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="child" role="tabpanel" aria-labelledby="child-tab">

                    @include('deaths.new_certificate.child_info')

                </div>
                <div class="tab-pane fade " id="mother" role="tabpanel" aria-labelledby="mother-tab">

                    @include('deaths.new_certificate.mother_info')

                </div>

                <div class="tab-pane fade" id="father" role="tabpanel" aria-labelledby="father-tab">
                    @include('deaths.new_certificate.father_info')


                </div>
                <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">

                    @include('deaths.new_certificate.attchments_info')

                </div>


                <div class="tab-pane fade" id="actions" role="tabpanel" aria-labelledby="actions-tab">

                    @include('deaths.new_certificate.actions')


                </div>


            </div>
        </div>


    </div>


@stop
