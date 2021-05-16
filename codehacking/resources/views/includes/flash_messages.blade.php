@if(Session::has('comment_message'))
    <div class="alert alert-success"> {{session('comment_message')}} </div>
@endif
@if(Session::has('reply_message'))
    <div class="alert alert-success"> {{session('reply_message')}} </div>
@endif
