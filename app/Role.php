<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table =  'Role';

    protected $primaryKey = 'RoleId';

    public $timestamps = false;


}
