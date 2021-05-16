@extends('layouts.admin')
@section('content')

    @if(Session::has('added_post'))
        <div class="alert alert-success"> {{session('added_post')}} </div>
    @endif
    @if(Session::has('deleted_post'))
        <div class="alert alert-danger"> {{session('deleted_post')}} </div>
    @endif
    @if(Session::has('updated_post'))
        <div class="alert alert-success"> {{session('updated_post')}} </div>
    @endif
    <h1> Posts </h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Photo</th>
          <th scope="col">Owner</th>
          <th scope="col">Category</th>

          <th scope="col">Post link</th>
          <th scope="col">Comments</th>
          <th scope="col">Created</th>
          <th scope="col">Updated</th>
        </tr>
      </thead>
      <tbody>
      @if($posts)
          @foreach($posts as $post)
        <tr>
          <th scope="row">{{$post->id}}</th>
            <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a> </td>

            <td><img height="50px" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}?" ></td>
          <td>{{$post->user->name}}</td>
          <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
            <td><a href="{{route('home.post',$post->slug)}}">View post</a>  </td>
            <td><a href="{{route('comments.show',$post->id)}}">View comments</a>  </td>
          <td>{{$post->created_at->diffForHumans()}}</td>
          <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>

        @endforeach
        @endif
      </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
{{--          I njejti san po ma i vjeter  {{$posts->render()}}--}}
            {{$posts->links()}}
        </div>
    </div>
@endsection
