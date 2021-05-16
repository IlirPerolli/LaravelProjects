<x-home-master>

@section('content')

        @foreach($posts as $post)
        <!-- Blog Post -->
        <div class="card mb-4">
            @if($post->post_image)
            <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{$post->title}}</h2>
                <p class="card-text">{{Str::limit($post->body,'50','...')}}</p>
                <a href="{{route('post', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                Posted on {{$post->created_at->diffForHumans()}} by
                <a href="#">{{$post->user->name}}</a><br>
                Updated on {{$post->updated_at->diffForHumans()}} by
                <a href="#">{{$post->user->name}}</a>
            </div>
        </div>

            @endforeach

@endsection
</x-home-master>
