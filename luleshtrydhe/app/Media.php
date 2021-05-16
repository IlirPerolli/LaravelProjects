<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $uploads = '/media/';
    protected $fillable = ['file'];
    public function getFileAttribute($value){
        return $this->uploads.$value;
    }
}
