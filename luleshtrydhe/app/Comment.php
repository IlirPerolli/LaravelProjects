<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','post_id','author','photo','email','body','is_active'];
    public function replies(){
        return $this->hasMany('App\CommentReply');
    }
    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
