@extends('layouts.admin')

@section('content')

    @if(count($comments)>0)
        <h1>Comments</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Author</th>
          <th scope="col">Email</th>
          <th scope="col">Body</th>

        </tr>
      </thead>
      <tbody>
       @foreach($comments as $comment)
        <tr>
          <th scope="row">{{$comment->id}}</th>
          <td>{{$comment->author}}</td>
          <td>{{$comment->email}}</td>
          <td>{{$comment->body}}</td>
          <td><a href="{{route('home.post',$comment->post->slug)}}">View Post </a> </td>
          <td><a href="{{route('replies.show',$comment->id)}}">View Replies </a> </td>
            <td>@if($comment->is_active == 1)
                    {!! Form::open(['method' => 'PATCH', 'action'=>['PostCommentsController@update',$comment->id]]) !!}

                            <div class="form-group">
                                <input type="hidden" name="is_active" value="0">
                            {!! Form::submit('Un-approve', ['class'=>'btn btn-info']) !!}
                            </div>

                        {!! Form::close() !!}
                    @else
                    {!! Form::open(['method' => 'PATCH', 'action'=>['PostCommentsController@update',$comment->id]]) !!}

                    <div class="form-group">
                        <input type="hidden" name="is_active" value="1">
                        {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                    @endif
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'action'=>['PostCommentsController@destroy',$comment->id]]) !!}

                <div class="form-group">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                </div>

                {!! Form::close() !!}
            </td>
        </tr>
       @endforeach
      </tbody>
    </table>
    @else
            <h1 class="text-center">No comments</h1>
    @endif

@endsection
