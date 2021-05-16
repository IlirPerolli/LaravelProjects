<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable; //Per pretty url
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{

    use Sluggable;
    use SluggableScopeHelpers;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=> true,
            ]
        ];
    }

    protected $fillable = ['category_id','photo_id','title','body'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function comments(){
      //  return $this->hasMany('App\Post');
      return $this->hasMany('App\Comment');
    }
    public function photoPlaceholder(){
        return "http://placehold.it/400x400";
    }
}
