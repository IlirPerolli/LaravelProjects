@extends('layouts.blog-home')

@section('content')
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">



            <h1 class="page-header">
                All Posts
                {{--                <small>Secondary Text</small>--}}
            </h1>
        @if($posts)
        @foreach($posts as $post)
            <!-- First Blog Post -->
                <h2>
                    <a href="{{route('home.post',$post->slug)}}">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="{{route('user.profile', $post->user->id)}}">{{$post->user->name}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
                <p><i class="fa fa-list-alt" aria-hidden="true"> </i> <a href="{{route('home.posts.category', $post->category->id)}}">{{$post->category->name}}</a></p>
                <hr>
                <img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="">
                <hr>
                <p>{{Str::limit($post->body,100)}}</p>
                <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- End Blog Post -->

            @endforeach
            @endif
            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$posts->links()}}
                </div>
            </div>


        </div>
@endsection
