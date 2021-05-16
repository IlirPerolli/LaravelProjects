<x-admin-master>
    @section('content')
        @if(session()->has('permission-updated'))
            <div class="alert alert-success">{{session('permission-updated')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-6">

                <h1> Edit Permission: {{$permission->name}}</h1>
                <form action="{{route('permissions.update', $permission->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$permission->name}}">
                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror

                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Update </button>

                </form>
            </div>
        </div>


    @endsection
</x-admin-master>
