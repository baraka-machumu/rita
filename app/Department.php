<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $table= 'Department';
    protected $primaryKey =  'DepartmentID';

    public $timestamps = false;
}
