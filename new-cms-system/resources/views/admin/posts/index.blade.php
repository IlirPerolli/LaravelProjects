<x-admin-master>
    @section('content')
    @if(Session::has('message'))
        <div class="alert alert-danger"> {{Session::get('message')}} </div>
        @elseif(Session::has('post-created-message'))
            <div class="alert alert-success"> {{Session::get('post-created-message')}} </div>
        @elseif(Session::has('post-updated-message'))
            <div class="alert alert-success"> {{Session::get('post-updated-message')}} </div>

        @endif

        <h1> All Posts</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->user->name}}</td>
                            <td><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></td>
                            <td>
                                @if($post->post_image)
                                <img height="40px" src="{{$post->post_image}}"/>
                                    @endif
                            </td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                            <td>
{{--                                 Kjo can lidhet me policy pra nese ky perdorues mund ta sheh metoden post atehere lejo ta fshije--}}
                                @can('view', $post)
                                <form method="post" action="{{route('post.destroy', $post->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div class="d-flex"><div class="mx-auto">
        {{$posts->links()}}</div>
        </div>
    @endsection
@section('scripts')

        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
{{--            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}

        @endsection
</x-admin-master>
