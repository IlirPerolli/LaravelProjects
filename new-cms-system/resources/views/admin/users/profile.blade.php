<x-admin-master>
    @section('content')
    <h1>User Profile for: {{$user->name}}</h1>
    @if(Session::has('success-update'))
            <div class="alert alert-success"> {{Session::get('success-update')}} </div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('user.profile.update',$user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img class="img-thumbnail rounded-circle" style="width:250px; height: 250px" src="{{$user->avatar}}">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>
                    <div class="mb-4">
                        <img src="" alt=""/>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username"
                               class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="" placeholder="Enter username" value="{{$user->username}}">
                    </div>
                    @error('username')
                    <div class="alert alert-danger">
                    {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name"
                               class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" aria-describedby="" placeholder="Enter name" value="{{$user->name}}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email"
                               class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="email" aria-describedby="" placeholder="Enter email" value="{{$user->email}}">
                    </div>
                    @error('email')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="title">Password</label>
                        <input type="password" name="password"
                               class="form-control" id="password" aria-describedby="" placeholder="Enter password">
                    </div>
                    @error('password')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="password-confirmation">Password</label>
                        <input type="password" name="password-confirmation"
                               class="form-control" id="password-confirmation" aria-describedby="" placeholder="Re-Enter password">
                    </div>
                    @error('password_confirmation')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                <button type="submit" class="btn btn-primary"> Submit</button>
                </form>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($roles as $role)
                            <tr>
                                <td><input type="checkbox"
                                    @foreach($user->roles as $user_role)
                                        @if ($user_role->slug == $role->slug)
                                            checked
                                            @endif
                                        @endforeach

                                    ></td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>
                                <form action="{{route('user.role.attach', $user)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{$role->id}}" >
                                   <button class="btn btn-primary"  @if($user->roles->contains($role))
                                   disabled
                                       @endif >Attach</button>
                                </form>
                                </td>
                                <form action="{{route('user.role.detach', $user)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{$role->id}}" >
                                    <td><button class="btn btn-danger" @if(!$user->roles->contains($role))
                                        disabled
                                            @endif >Dettach</button></td>
                                </form>

                            </tr>
                                @endforeach



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endsection

</x-admin-master>
