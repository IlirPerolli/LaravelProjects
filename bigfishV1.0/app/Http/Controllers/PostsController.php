<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index(){

    }
    public function create()
    {
        return view('posts.create');
    }
    public function create_multiple()
    {
        return view('posts.multi_create');
    }
    public function store(Request $request)
    {

        $user = Auth::user();
        $input = $request->all();
        $request->validate(['photo_id'=>'required|mimes:jpeg,png,jpg,svg|max:2048']);
        if ($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            //$upload_url = public_path('/images').'/'.$name;
            //$filename = $this->compress_image($_FILES["photo_id"]["tmp_name"], $upload_url, 40);
            $photo = Photo::create(['photo'=>$name]);
            $input['photo_id']=$photo->id;
        }
        if($request->body == null){
            $input['slug']= time().Str::random(30);
        }

        $input['user_id']=$user->id;
        $user->posts()->create($input);
        session()->flash('added_post', 'Post created successfully');
        return back();
    }
    public function store_multiple(Request $request){

        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();
        $file->move('images', $name);
        $user = Auth::user();
        $photo = Photo::create(['photo'=>$name]);
        $user = auth()->user();
        $slug = time().Str::random(30);
        $input = ['user_id'=>$user->id,'photo_id'=>$photo->id, 'slug'=>$slug];
        $user->posts()->create($input);


    }

    public function show($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $user = $post->user;
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        $likes = $post->likes->count();
        $views = $post->views+1;
        $post->update(['views'=>$views]);
        $comments = $post->comments;
        return view('posts.show', compact('post','followers' , 'followings','user_posts', 'likes','views', 'comments'));
    }
    public function edit($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        if (auth()->user()->id != $post->user->id){
            abort(403, 'Unauthorized action.');
        }
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id != $post->user->id){
            abort(403, 'Unauthorized action.');
        }
        $post->body = $request->body;
        if($post->isDirty('body')){
            if($request->body == null){
               $slug = $post->slug = time().Str::random(30);
            }
            else{
                $slug = SlugService::createSlug(Post::class, 'slug', $post->body);
            }
            session()->flash('post_updated', 'Post has been updated');
            $post->save();
            return redirect()->route('post.edit',$slug);
        }
        else{
            session()->flash('nothing_updated', 'Nothing has been updated');

        }
        return back();

    }
    public function destroy(Post $post)
    {
        if (auth()->user()->id != $post->user_id){
            abort(403, 'Unauthorized action.');
        }
        if ($post->photo){
            unlink(public_path().$post->photo->photo);
        }
        $post->delete();
        session()->flash('deleted_post', 'The post has been deleted');
        return redirect()->route('user.show',auth()->user()->slug);
    }
//    public  function compress_image($source_url, $destination_url, $quality) {
//        $info = getimagesize($source_url);
//        if ($info['mime'] == 'image/jpeg')
//            $image = imagecreatefromjpeg($source_url);
//        elseif ($info['mime'] == 'image/gif')
//            $image = imagecreatefromgif($source_url);
//        elseif ($info['mime'] == 'image/png')
//            $image = imagecreatefrompng($source_url);
//        imagejpeg($image, $destination_url, $quality);
//        return $destination_url;
//    }
        //Nese deshirojme te kompresojme filet e kemi kete mundesi prej ketij funksioni

}
