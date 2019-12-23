
@extends('layouts.master')

@section('heading-title')

    <h2>New Role</h2>
@endsection


@section('content')

    <div class="row">



        <form method="post" action="{{url('roles/store')}}">

            {{csrf_field()}}
            <div class="col-md-12">

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p>
                    @endif
                @endforeach


                <div class="form-group">
                    <label for="role-name">Role Name</label>
                    <input type="text" name="name" id="role-name" class="form-control">


                </div>


            </div>


            <div class="col-md-12">


                <table class="table">

                    <thead>

                    <tr style="background-color: #0E6BB7; color: white;">
                        <td colspan="12">Select Permission(s)</td>
                    </tr>

                </table>


            </div>

            <div class="col-md-4">

                <ul class="rol-perm-list">
                    @foreach($permissions as  $index=>$permission)

                        @if(($index)<3)


                            <li>


                                <span class="perm-role-span"><input type="checkbox" name="permission[]" class="checkbox-custom" value="{{$permission['PermissionID']}}"> {{$permission['PermissionName']}} </span>

                            </li>

                        @endif

                    @endforeach

                </ul>

            </div>

            <div class="col-md-4">
                <ul class="rol-perm-list">
                    @foreach($permissions as $index=>$permission)

                        @if(($index)>=3 && ($index)<=5 )
                            <li>
                                <span class="perm-role-span"><input type="checkbox" name="permission[]" class="checkbox-custom" value="{{$permission['PermissionID']}}"> {{$permission['PermissionName']}} </span>
                            </li>

                        @endif
                    @endforeach
                </ul>

            </div>
            <div class="col-md-4">

                <ul class="rol-perm-list">
                    @foreach($permissions as  $index=>$permission)
                        @if(($index)>=6)
                            <li>
                                <span class="perm-role-span"><input type="checkbox" name="permission[]" class="checkbox-custom" value="{{$permission['PermissionID']}}"> {{$permission['PermissionName']}} </span>
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
