@extends('layouts.admin')

@section('content')
    @if(Session::has('deleted_user'))
        <div class="alert alert-danger"> {{session('deleted_user')}} </div>
        @endif
    @if(Session::has('added_user'))
        <div class="alert alert-success"> {{session('added_user')}} </div>
    @endif
    @if(Session::has('updated_user'))
        <div class="alert alert-success"> {{session('updated_user')}} </div>
    @endif
    <h1>Users</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <th scope="row"><img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}"></th>
{{--            <th scope="row"> @if ($user->photo)<img height="50" src="{{$user->photo->file}}"> @else No user photo @endif </th>--}}
            <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active == 1 ? 'Active' : 'Not active'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
@endsection
