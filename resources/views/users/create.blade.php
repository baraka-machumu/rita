
@extends('layouts.master')

@section('heading-title')

    <h2>Register New User</h2>
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


        <form action="{{url('users/store')}}" method="post">

            {{csrf_field()}}

            <div class="col-md-6">

                <div class="form-group">
                    <label for="staff-reg-no">Staff Registration  Number</label>
                    <input type="text" name="staff_reg_no" id="staff-reg-no" value="{{old('staff_reg_no')}}" class="form-control">


                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username"  value="{{old('username')}}" class="form-control">


                </div>


                <div class="form-group">
                    <label for="office">Office</label>
                    <select  name="office" id="office" class="form-control" name="office">

                        <option selected disabled>Please Select Office</option>
                        @foreach($offices as $office)

                            <option value="{{$office['RitaOfficeID']}}">{{$office['OfficeName']}}</option>

                        @endforeach
                    </select>

                </div>


                <div class="form-group">
                    <label for="office">Department</label>
                    <select id="office" class="form-control" name="department">

                        <option selected disabled>Please Select Department</option>
                        @foreach($departments as $department)

                            <option value="{{$department['DepartmentID']}}">{{$department['DepartmentName']}}</option>

                        @endforeach
                    </select>

                </div>


            </div>


            <div class="col-md-6">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{old('email')}}" id="email" class="form-control">


                </div>

                <div class="form-group">
                    <label for="phone-number">Phone Number</label>
                    <input type="text" name="phone_number" value="{{old('phone_number')}}" id="phone-number" class="form-control">


                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" value="{{old('password')}}" id="password" class="form-control">

                </div>

            </div>

            <div class="col-md-12">


                <table class="table">


                    <tr style="background-color: #0E6BB7; color: white;">
                        <td colspan="12">Select Permission(s)</td>
                    </tr>

                </table>


            </div>

            <div class="col-md-4">

                <ul class="rol-perm-list">
                    @foreach($permissions as  $index=>$permission)

                        @if(($index)<5)

                            <li>

                                <span class="perm-role-span"><input  type="checkbox" name="permission[]" class="checkbox-custom" value="{{$permission['PermissionID']}}"> {{$permission['PermissionName']}} </span>

                            </li>

                        @endif

                    @endforeach

                </ul>

            </div>




            <div class="col-md-12" style="margin-top: 10px;">

                <div class="form-group">

                    <button class="btn btn-info" type="submit">Save</button>

                </div>
            </div>


        </form>


    </div>

@endsection
