@extends('layouts.blog-home')

@section('content')
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                All Posts
                {{--                <small>Secondary Text</small>--}}
            </h1>
    @foreach($posts as $post)
    <!-- First Blog Post -->
    <h2>
        <a href="{{route('home.post',$post->slug)}}">{{$post->title}}</a>
    </h2>
    <p class="lead">
        by <a href="index.php">{{$post->user->name}}</a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
    <p><i class="fa fa-list-alt" aria-hidden="true"> </i> <a href="{{route('home.posts.category', $post->category->id)}}">{{$post->category->name}}</a></p>
    <hr>
    <img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="">
    <hr>
    <p>{{$post->body}}</p>
    <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

    <hr>

    <!-- End Blog Post -->

    @endforeach
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->links()}}
        </div>
    </div>
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>
@endsection
