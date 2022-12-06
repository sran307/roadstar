@extends("layouts.layout")
@section("title", "edit_comment")
@section("content")
<div class="container">
    @foreach($comments as $comment)
    <form action="{{route('comment_models.update', [$comment->id])}}" method="post">
    @csrf
    @method("put")
      <legend class="col-form-label">Edit Comment</legend>
        <div class="row form-group">
        <label for="title" class="col-md-2 col-form-label">Blog <span class="star">*</span></label>
            <div class="col-md-8"> 
               <select name="blog" class="form-control" id="">
                   <option value="">select a blog</option>
                   @foreach($blogs as $blog)
                   <option value="{{$blog->id}}" <?php if($blog->id == $comment->blog_id){ echo("selected");}?>>{{$blog->title}}</option>
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
                <input type="text" name="comment" placeholder="Enter your comment" class="form-control" value="{{$comment->comment}}"> 
                @if($errors->has("comment"))
                    <span class="alert alert-danger">{{$errors->first("comment")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection