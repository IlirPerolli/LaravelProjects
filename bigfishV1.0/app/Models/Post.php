<?php

namespace App\Models;



use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'body',
                'onUpdate'=> true,
            ]
        ];
    }
    use HasFactory;
    protected $fillable = ['photo_id','body', 'views', 'slug'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function photo(){
        return $this->belongsTo(Photo::class);
    }
    public function comments(){

        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps()->withPivot('user_id', 'post_id');
    }
}
