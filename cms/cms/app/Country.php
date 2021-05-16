<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function posts(){
        //Kete sinkakse e ben automatikisht, dhe nese i kemi ndryshe kolonat duhet edhe ktu t'i ndryshojme
        // return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
    return $this->hasManyThrough('App\Post','App\User');
    }
}
