<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Per te mundesuar fshirjen e lehte (sikur ta veme ne shporte)
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
        public $directory = "/images/";
        //Duhet te perdoret pastaj softdeletes dhe te mbishkrhet variabla dates.
        //Me pas duhet te leshohet migrimi php artisan make:migration add_deleted_at_column_to_posts_tables --table=posts
        use SoftDeletes;
        protected $dates = ['deleted_at'];
//    kur modeli eshte post atehere mendon qe tabela eshte posts (shumes) dhe
//  nese deshirojme ta ndryshojme kete e bejme me protected $table = (emri i tabeles)
//  njejte edhe per primary key nese kemi primarykey ndryshe se id
//    protected $table = 'posts';
//    protected $primaryKey = 'id';
//
//e bejme kte per te japur me shume te dhena ne insertim ne forme te array.
protected $fillable = [
    'title',
    'content',
    'path'
];
public function user(){
    return $this->belongsTo('App\User');
}

//Me kete funksion lidhemi me tabelen Photo dhe keshtu ajo do ta gjeje id tone me ane te kolones imageable_id
public function photos(){
    //Imageable -> emri i funksionit
    return $this->morphMany('App\Photo', 'imageable');
}
public function tags(){
    //Taggable -> emri i modelit
    return $this->morphToMany('App\Tag', 'taggable');
}
public static function scopeLatest($query){
    return $query->orderBy('id', 'asc')->get();
}
//Tek index.blade.php mos ta shkruajme images/alajdflkajdsf e bejme me kte dmth e merr prej databazes dhe e shfaq me direktorien /images
public function getPathAttribute($value){
    return $this->directory.$value;
}
}
