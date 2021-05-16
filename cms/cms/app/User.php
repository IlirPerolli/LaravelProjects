<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    //Shikon user_id ne tabelen post. Nese eshte e quajtur ndryshe user_id atehere e shkruajme hasOne('App\Post','emriIkolones');
    public function post(){
    return $this->hasOne('App\Post');
    }
    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function roles(){
        //Nese deshirojme t'iu qasemi edhe tabeles role_user atehere e specifikojme cilat kolona deshirojme t'i shfaqim.

        return $this->belongsToMany('App\Role')->withPivot('created_at');
        //Nese kemi emrin e tabeles ndryshe etj.
        // return $this->belongsToMany('App\Role','user_roles', 'user_id', 'role_id')
    }
    public function photos(){
        //Imageable -> emri i funksionit
        return $this->morphMany('App\Photo', 'imageable');
    }
    //gjithmone duhet te vendosim get pastaj emrin e kolones dhe ne fund attribute dmth i ndryshojme ketu dhe kur i shfaqim dalin sipas kesaj
    public function getNameAttribute($value){
    return ucfirst($value);
    }
    //e njejta si kjo larte vetem se kjo perdoret per te ruajtur te dhenat ne databaze e jo te shfaqim
    public function setNameAttribute($value){
        $this->attributes['name'] = strtoupper($value);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
