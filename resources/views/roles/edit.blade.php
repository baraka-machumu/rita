
@extends('layouts.master')

@section('heading-title')

    <h2>New Role</h2>
@endsection


@section('content')

    <div class="row">



        <form method="post" action="{{url('roles/update',$roleId)}}">

            {{csrf_field()}}
            <div class="col-md-12">

                <div class="form-group">
                    <label for="role-name">Role Name</label>
                    <input type="text" name="name" id="role-name" value="{{$roleName}}" class="form-control">


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

                        @if(($index)<25)


                            <li>


                                <span class="perm-role-span">
                                    <input type="checkbox" name="permission[]"

                                           @foreach ($role as $r) @if($permission['PermissionID'] == $r->PermissionID ) checked @endif
                                           @endforeach

                                           class="checkbox-custom" value="{{$permission['PermissionID']}}">

                                    {{$permission['PermissionName']}} </span>

                            </li>

                        @endif

                    @endforeach

                </ul>

            </div>

            <div class="col-md-4">
                <ul class="rol-perm-list">
                    @foreach($permissions as $index=>$permission)

                        @if(($index)>=25 && ($index)<39 )
                            <li>

                                    <span class="perm-role-span">
                                    <input type="checkbox" name="permission[]"

                                           @foreach ($role as $r) @if($permission['PermissionID'] == $r->PermissionID ) checked @endif
                                           @endforeach

                                           class="checkbox-custom" value="{{$permission['PermissionID']}}">

                                    {{$permission['PermissionName']}} </span>


                            </li>

                        @endif
                    @endforeach
                </ul>

            </div>

            <div class="col-md-4">

                <ul class="rol-perm-list">
                    @foreach($permissions as  $index=>$permission)
                        @if(($index)>=39)
                            <li>

                                    <span class="perm-role-span">
                                    <input type="checkbox" name="permission[]"

                                           @foreach ($role as $r) @if($permission['PermissionID'] == $r->PermissionID ) checked @endif
                                           @endforeach

                                           class="checkbox-custom" value="{{$permission['PermissionID']}}">

                                    {{$permission['PermissionName']}} </span>



                            </li>

                        @endif

                    @endforeach

                </ul>

            </div>

            <div class="col-md-12" style="margin-top: 10px;">

                <div class="form-group">

                    <button class="btn btn-info" type="submit">Update</button>

                </div>
            </div>


        </form>

    </div>

@endsection
