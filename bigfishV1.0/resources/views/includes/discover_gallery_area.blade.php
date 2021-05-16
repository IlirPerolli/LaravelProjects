<!--================Home Gallery Area =================-->
<section class="home_gallery_area p_120">
    <div class="container box_1620"> <h3 class="text-center" style="margin-bottom: 50px;">Discover Posts</h3>
    <div class="container box_1620">
        @if(count($posts)>0)
        <div class="gallery_f_inner row imageGallery1">

            @foreach($posts as $post)

                <div class="col-lg-3 col-md-4 col-sm-6 ap">
                    <div style="text-align: left"><a href="{{route('user.show',$post->user->slug)}}" style="color:#777777;">{{"@".$post->user->username}}</a></div>

                    <div class="h_gallery_item">
                        <img src="{{$post->photo->photo}}" alt="">
                        <div class="hover">
                            @if($post->body)
                                <a href="{{route('post.show',$post->slug)}}"><h4>{{$post->body}}</h4></a>
                            @else
                                <a href="{{route('post.show',$post->slug)}}"><h4>(No description)</h4></a>
                            @endif
                            <a class="light" href="{{$post->photo->photo}}"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                </div>


            @endforeach

        </div>
        @else
            <h4 class="text-center" style="color:red">No posts found</h4>
        @endif
{{--        <div class="button_more">--}}
{{--            <a class="btn theme_btn" href="#">Load More Images</a>--}}
{{--        </div>--}}
{{--    </div>--}}
        <nav aria-label="Pagination" style="margin-top: 50px">
            <ul class="pagination justify-content-center">
                {{$posts->links()}}
            </ul>
        </nav>
    </div></div>
</section>
<!--================End Home Gallery Area =================-->
