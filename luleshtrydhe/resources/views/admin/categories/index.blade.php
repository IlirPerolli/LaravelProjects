@extends('layouts.admin')
@section('content')
    @if(Session::has('added_category'))
        <div class="alert alert-success"> {{session('added_category')}} </div>
    @endif
    @if(Session::has('deleted_category'))
        <div class="alert alert-danger"> {{session('deleted_category')}} </div>
    @endif
    @if(Session::has('updated_category'))
        <div class="alert alert-success"> {{session('updated_category')}} </div>
    @endif
    <h1>Categories</h1>
    <div class="col-sm-6">
          {!! Form::open(['method' => 'post', 'action'=>'AdminCategoriesController@store']) !!}
              <div class="form-group">
                  {!! Form::label('name', 'Name') !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>
                  <div class="form-group">
                  {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
                  </div>

              {!! Form::close() !!}
    </div>
    <div class="col-sm-6">
        @if($categories)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created date</th>
                    <th scope="col">Updated date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans(): "No date available"}}</td>
                        <td>{{$category->updated_at ? $category->updated_at->diffForHumans(): "No date available"}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
            @include('includes.form_error')
    </div>
    @endsection
