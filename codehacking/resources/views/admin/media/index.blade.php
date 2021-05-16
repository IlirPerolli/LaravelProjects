@extends('layouts.admin')

@section('content')
    @if(Session::has('deleted_photo'))
        <div class="alert alert-danger"> {{session('deleted_photo')}} </div>
    @endif
    <h1>Media</h1>
    @if($photos)

        <form action="delete/media" method="post" class="form-inline">
        @csrf
            @method('DELETE')
            <div class="form-group">
        <select name="checkBoxArray" class="form-control">
            <option value="">Delete</option>
        </select>
    </div>
            <div class="form-group">
                <input type="submit" name="delete_all" class="btn btn-danger" value="Delete">
            </div>
    <table class="table table-striped">
      <thead>
        <tr>
            <th><input type="checkbox" id="options"></th>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Created Date</th>
        </tr>
      </thead>
      <tbody>
      @foreach($photos as $photo)
        <tr>
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}" ></td>
          <th scope="row">{{$photo->id}}</th>
          <td><img src="{{$photo->file}}" height="50px"/></td>
          <td>{{$photo -> created_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
        </form>
    @endif

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
           $('#options').click(function(){
               if(this.checked){
                   $('.checkBoxes').each(function(){
                      this.checked = true;
                   });
               }
               else{
                   $('.checkBoxes').each(function(){
                       this.checked = false;
                   });
               }
              //$('.checkBoxes').click();
           });
        });
    </script>
@endsection
