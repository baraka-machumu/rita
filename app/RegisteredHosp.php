<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredHosp extends Model
{
    //

    protected $table ='RegisteredHosp';

    public $timestamps =  false;

    public $primaryKey = "HospID";
}
