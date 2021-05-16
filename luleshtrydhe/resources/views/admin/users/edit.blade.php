@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>
    <div class="col-sm-3">
        <img class="img img-responsive img-rounded" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}">
    </div>
    <div class="col-sm-9">

{{--    Me kete model edhe $user e bejme si fill formen per ate perdorues--}}
    {!! Form::model($user,['method' => 'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id',[''=>'Choose Options']+$roles, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', array(1 =>'Active', 0=>'Not Active'),null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'Image:') !!}
        {!! Form::file('photo_id',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-3']) !!}
    </div>

    {!! Form::close() !!}
<div class="col-sm-1"></div>
            {!! Form::open(['method' => 'delete', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

                    <div class="form-group">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-3']) !!}
                    </div>

                {!! Form::close() !!}
<br><br>
    @include('includes.form_error')
    </div>


@endsection
