<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //route name posts.index
//        $posts = Post::latest()->get();
//        $posts = Post::orderBy('id', 'desc')->get();
        $post = Post::latest();
        $posts = Post::all();
        return view('posts.index', compact('posts'));
        //Opsionale kur kemi 1 parameter
        //return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $input = $request->all();

        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            //Path eshte variabla e databazes dhe pse e bejme kete eshte se me are request na jep vlerat e vargut dhe ne deshirojme qe ne path te mos ipet vlera temporary por emri aktual i files
            $input['path'] = $name;
        }
        Post::create($input);

//        $file = $request->file('file');
//
//        echo $file->getClientOriginalName();

//        $this->validate($request, [
//           'title'=>'required|max:50',
//           // 'content'=>'required'
//        ]); I heqim keto rreshta sepse e kemi deklaruar tek requesti CreatePostRequest


        //return $request->title;
        //return $request->get('title');

        //Menyra 1


       // Post::create($request->all());


        //Menyra 2
//        $input = $request->all();
//        $input['title'] = $request->title;
//        Post::create($request->all());
        //Menyra 3
//        $post = new Post;
//        $post->title = $request->title;
//        $post->save();
       //
         return redirect('/posts');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title=$request->title;
        $post->save();
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->ForceDelete();
        return redirect('/posts');
    }

    public function contact(){
        $people = ['Edwin', 'Jose', 'James', 'Peter', 'Maria'];

        return view('contact',compact('people'));
    }
    public function show_post($id, $name){
        // return view('post')->with('id_qe_percillet',$id);
        return view('post', compact('id','name'));
    }

}
