@extends("layouts.layout")
@section("title", "add_title")
@section("content")
<div class="container">
<form action="{{route('footer_titles.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add Footer Title</legend>
        <div class="row form-group">
            <label for="titles" class="col-md-2 col-form-label">Titles <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="title" placeholder="Enter the footer title" class="form-control" value="{{old('title')}}">
                @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
                @endif
            </div>
        </div>
  <!--      <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                   <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-10 text-center">
               <input type="submit" value="save">
            </div>
        </div>
    </form>
</div>
@endsection