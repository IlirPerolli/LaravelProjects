@extends('layouts.app')

@section('content')
    <h1> Edit post</h1>
    {!! Form::model($post,['method' => 'PATCH', 'action'=>['PostsController@update', $post->id]]) !!}
        {{csrf_field()}}

        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}


        {!! Form::submit('Update post', ['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}



    {!! Form::open(['method' => 'DELETE', 'action'=>['PostsController@destroy', $post->id]]) !!}
        {{csrf_field()}}

    {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}


    {!! Form::close() !!}
@endsection

@section('footer')
@endsection
