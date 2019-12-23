<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentRole extends Model
{


    public $timestamps  = false;
    protected $table = 'DepartmentRole';
    protected $primaryKey = 'DepartmentRoleID';
}
