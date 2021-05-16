@extends('layouts.admin')
@section('content')
    <h1>Categories</h1>
    <div class="col-sm-6">
        {!! Form::model($category,['method' => 'PATCH', 'action'=>['AdminCategoriesController@update',$category->id]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-3']) !!}
        </div>

        {!! Form::close() !!}
        <div class="col-sm-1"></div>
        {!! Form::open(['method' => 'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}

        <div class="form-group">
            {!! Form::submit('Detete Category', ['class'=>'btn btn-danger col-sm-3']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    <div class="col-sm-6">
        @include('includes.form_error')
    </div>

@endsection
