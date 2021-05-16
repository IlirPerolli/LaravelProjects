<!--================Home Gallery Area =================-->
<section class="home_gallery_area p_120" style="padding-top: 60px">
    <div class="container box_1620"> <h4 class="text-center" style="margin-bottom: 50px;">Gallery</h4>
        <div class="gallery_f_inner row imageGallery1">

            @foreach($posts as $post)
            <div class="col-lg-3 col-md-4 col-sm-6 ap">
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



    </div>
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            {{$posts->links()}}
        </ul>
    </nav>
</section>

<!--================End Home Gallery Area =================-->
