<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //protected $fillable = ['title', 'body'];
    protected $guarded = [];//Per te mos e bere protected fillable
    public function user(){
        return $this->belongsTo(User::class);
    }
//    public function setPostImageAttribute($value){
//        $this->attributes['post_image'] = asset('storage/'.$value);
//    }
    public function getPostImageAttribute($value){
        if ($value == NULL){
        return false;
        }
      return asset('storage/'.$value);
    }
}
