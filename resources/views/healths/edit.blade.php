
@extends('layouts.master')

@section('heading-title')

    <h2>Edit Department</h2>
@endsection

@section('content')

    <div class="row">

        <form method="post" action="{{url('departments/update',$departmentId)}}">

            {{csrf_field()}}
            <div class="col-md-12">

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p>
                    @endif
                @endforeach


                <div class="form-group">

                    <label for="department-name">Department Name</label>
                    <input type="text" name="name" id="department-name" value="{{$department->DepartmentName}}" class="form-control">

                </div>

            </div>

            <div class="col-md-12">

                <table class="table">

                    <thead>

                    <tr style="background-color: #0E6BB7; color: white;">
                        <td colspan="12">Selected Role(s)</td>
                    </tr>

                </table>

            </div>

            <div class="col-md-4">

                <ul class="rol-perm-list">
                    @foreach($roles as  $index=>$role)

                        <li>
                            <span class="perm-role-span"><input type="checkbox" name="role[]" class="checkbox-custom" value="{{$role['RoleID']}}"

                                 @foreach ($departmentRole as $r) @if($role->RoleID == $r->RoleID ) checked @endif
                                    @endforeach

                                > {{$role->RoleName}} </span>
                        </li>

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
