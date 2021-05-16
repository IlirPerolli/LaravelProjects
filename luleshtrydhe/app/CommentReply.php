<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = ['user_id','comment_id','author','photo','email','body','is_active'];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
