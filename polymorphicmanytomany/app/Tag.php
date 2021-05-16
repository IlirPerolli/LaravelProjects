<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    public function posts(){
        //Taggable -> emri i modelit
        return $this->morphedByMany('App\Post', 'taggable');
    }

    public function videos(){
        //Taggable -> emri i modelit
        return $this->morphedByMany('App\Video', 'taggable');
    }
}
