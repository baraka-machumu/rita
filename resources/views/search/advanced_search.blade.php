
@extends('layouts.master')

@section('heading-title')

    <h2>Advanced Search</h2>
@endsection

@section('content')

    <div class="row">


        <div class="col-md-12">

            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p>
                @endif
            @endforeach

        </div>


        <div class="col-md-12">

            <form action="{{url('advanced-search')}}" method="post">

                {{csrf_field()}}

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="staff-reg-no">Entry Number</label>
                        <input type="text" name="staff_reg_no" id="staff-reg-no" value="{{old('staff_reg_no')}}" class="form-control">


                    </div>


                    <div class="form-group">
                        <label for="staff-reg-no">Search Category</label>
                        <select  name="staff_reg_no" id="staff-reg-no" value="{{old('staff_reg_no')}}" class="form-control">


                            <option>History</option>
                            <option>On progress</option>


                        </select>


                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 10px;">

                    <div class="form-group">

                        <button class="btn btn-info" type="submit">Search</button>

                    </div>
                </div>


            </form>


        </div>


    </div>

@endsection
