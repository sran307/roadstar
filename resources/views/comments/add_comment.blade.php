@extends("layouts.layout")
@section("title", "add_comment")
@section("content")
<div class="container">
<form action="{{route('comment_models.store')}}" method="post">
    @csrf
      <legend class="col-form-label">Add Comment</legend>
        <div class="row form-group">
            <label for="title" class="col-md-2 col-form-label">Blog <span class="star">*</span></label>
            <div class="col-md-8"> 
               <select name="blog" class="form-control" id="">
                   <option value="">select a blog</option>
                   @foreach($blogs as $blog)
                   <option value="{{$blog->id}}">{{$blog->title}}</option>
                   @endforeach
               </select>
                @if($errors->has("blog"))
                    <span class="alert alert-danger">{{$errors->first("blog")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="comment" class="col-md-2 col-form-label">Comment <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="comment" placeholder="Enter your comment" class="form-control" value="{{old('comment')}}"> 
                @if($errors->has("comment"))
                    <span class="alert alert-danger">{{$errors->first("comment")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
              <button class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection