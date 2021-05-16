@extends('layouts.admin')
@section('content')
    @include('includes.tinyeditor')
    <h1> Edit Post </h1>
    <div class="col-sm-3">
        <img class="img img-responsive img-rounded" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}">
    </div>
    <div class="col-sm-9">
        {!! Form::model($post, ['method' => 'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', array(''=>'Choose Categories')+$categories, null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Description:') !!}
            {!! Form::textarea('body',null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Edit Post', ['class'=>'btn btn-primary col-sm-3']) !!}
        </div>

        {!! Form::close() !!}
        <div class="col-sm-1"></div>
        {!! Form::open(['method' => 'delete', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

        <div class="form-group">
            {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-3']) !!}
        </div>

        {!! Form::close() !!}
        <br><br>
        @include('includes.form_error')

@endsection
