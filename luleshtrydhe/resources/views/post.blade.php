@extends('layouts.blog-post')
@section('title')
    <title>{{$post->title}}</title>

@endsection
@section('content')
    @include('includes.flash_messages')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="{{route('user.profile', $post->user->id)}}">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
    <p><i class="fa fa-list-alt" aria-hidden="true"> </i> <a href="{{route('home.posts.category', $post->category->id)}}">{{$post->category->name}}</a></p>
    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="">
    <hr>

    <!-- Post Content -->
    <p>{!! $post->body !!}</p>
    <hr>

    <!-- Blog Comments -->
    @if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

           {!! Form::open(['method' => 'post', 'action'=>'PostCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="form-group">
                   {!! Form::label('body', 'Body') !!}
                   {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3]) !!}
               </div>
                   <div class="form-group">
                   {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
                   </div>

               {!! Form::close() !!}


    </div>
    @endif
    <hr>

    <!-- Posted Comments -->

    @if(count($comments)>0)

    @foreach($comments as $comment)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="{{route('user.profile', $comment->user->id)}}">
            <img class="media-object" src="{{$comment->user->photo->file}}" height="64px" alt="">
{{--            Si duhet te jete ne vertete qe ta tregon tamon foton e perdoruesit e jo vetem ne momentin e ngarkimit te fotos--}}
            {{--            <img class="media-object" src="{{$comment->post->user->photo ? $comment->post->user->photo->file : 'http://placehold.it/400x400'}}" height="64px" alt="">--}}
        </a>
        <div class="media-body">
            <h4 class="media-heading"> <a href="{{route('user.profile', $comment->user->id)}}"> {{$comment->author}}</a>
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>
        @if(count($comment->replies)>0)
            @foreach($comment->replies as $reply)

            @if($reply->is_active == 1)

            <!-- Nested Comment -->
            <div class="media" id="nested-comment">
                <a class="pull-left" href="{{route('user.profile', $reply->user->id)}}">
                    <img class="media-object" src="{{$reply->user->photo->file}}" height="64px" alt="">
                    {{--            Si duhet te jete ne vertete qe ta tregon tamon foton e perdoruesit e jo vetem ne momentin e ngarkimit te fotos--}}

                    {{--                    <img class="media-object" src="{{$reply->comment->post->user->photo ? $reply->comment->post->user->photo->file : 'http://placehold.it/400x400'}}" height="64px" alt="">--}}

                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="{{route('user.profile', $reply->user->id)}}"> {{$reply->author}} </a>
                        <small>{{$reply->created_at->diffForHumans()}}</small>
                    </h4>
                <p>{{$reply->body}}</p>
                </div>

            <!-- End Nested Comment -->

                </div>


                @endif
                @endforeach


            @else
                <h4 class="text-center">No Replies</h4>
            @endif
            @if(Auth::check())
            <div class="comment-reply-container">
                <button class="toggle-reply btn btn-primary pull-right">
                    Reply
                </button>
                <div class="comment-reply col-sm-6">

                    {!! Form::open(['method' => 'post', 'action'=>'CommentRepliesController@createReply']) !!}
                    <div class="form-group">
                        <input type="hidden" name="post_id" value="{{$comment->id}}"
                        {!! Form::label('body', 'Body:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create reply', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
@endif

        </div>
    </div>
        @endforeach

@endif


@endsection
@section('scripts')
    <script>
        $(".comment-reply-container .toggle-reply").click(function(){
           $(this).next().slideToggle("slow");
        });
    </script>

@endsection
