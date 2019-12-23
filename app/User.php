<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'Email', 'Password',
    ];


    protected $table = 'Staff';

    public $timestamps =  false;

    protected $primaryKey  = 'StaffID';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getAuthPassword()
    {
        return  $this->Password;
    }


    public  static  function  office(){

        return DB::table('RitaOffice')->
        where('RitaOfficeID',auth()->user()->RitaOfficeID)->first()->OfficeName;

    }

    public   function ritaOffice(){

//        return $this->hasOne('App\RitaOffice','RitaOfficeID','StaffID');

        return $this->belongsTo('App\RitaOffice','RitaOfficeID','StaffID');
    }


}
