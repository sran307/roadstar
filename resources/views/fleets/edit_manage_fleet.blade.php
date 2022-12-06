@extends("layouts.layout")
@section("title", "edit_fleet")
@section("content")
<div class="container">
<form action="{{route('manage_fleets.update', $fleet->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Fleet</legend>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Vehicle code<span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="vehicle_code" placeholder="Enter the vehicle code" class="form-control" value="{{$fleet->code}}"> 
                @if($errors->has("vehicle_code"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_code")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="title" class="col-md-2 col-form-label">Title <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="title" placeholder="Enter the title" class="form-control" value="{{$fleet->title}}"> 
                @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="brands" class="col-md-2 col-form-label">Category <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="category" id="" class="form-control">
                   <option value="">Select Category</option>
                   @foreach($categories as $category)
                    <option value="{{$category->id}}" <?php if($category->id==$fleet->category){echo "selected"; }?>>{{$category->name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("category"))
                    <span class="alert alert-danger">{{$errors->first("category")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="brands" class="col-md-2 col-form-label">Brands <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="brand" id="" class="form-control">
                   <option value="">Select Brand</option>
                   @foreach($brands as $brand)
                    <option value="{{$brand->id}}" <?php if($brand->id==$fleet->brand){echo "selected"; }?>>{{$brand->brand_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("brand"))
                    <span class="alert alert-danger">{{$errors->first("brand")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="models" class="col-md-2 col-form-label">Models <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="model" id="" class="form-control">
                   <option value="">Select Model</option>
                   @foreach($models as $model)
                    <option value="{{$model->id}}" <?php if($model->id==$fleet->model){echo "selected"; }?>>{{$model->model_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("model"))
                    <span class="alert alert-danger">{{$errors->first("model")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="variant" class="col-md-2 col-form-label">Variant <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="variant" placeholder="Enter the variant" class="form-control" value="{{$fleet->variant}}"> 
                @if($errors->has("variant"))
                    <span class="alert alert-danger">{{$errors->first("variant")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="variant" class="col-md-2 col-form-label">Bags <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="bags" placeholder="Enter the number of air bags" class="form-control" value="{{$fleet->bags}}"> 
                @if($errors->has("bags"))
                    <span class="alert alert-danger">{{$errors->first("bags")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="chase" class="col-md-2 col-form-label">Chase Number <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="chase_number" placeholder="Enter the chase number" class="form-control" value="{{$fleet->chase_number}}"> 
                @if($errors->has("chase_number"))
                    <span class="alert alert-danger">{{$errors->first("chase_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle" class="col-md-2 col-form-label">Vehicle Number <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="vehicle_number" placeholder="Enter the vehicle number" class="form-control" value="{{$fleet->vehicle_number}}"> 
                @if($errors->has("vehicle_number"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date1" class="col-md-2 col-form-label">Date Of Registration <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="date" name="date_of_registration" placeholder="Enter the vehicle number" class="form-control" value="{{$fleet->date_registration}}"> 
                @if($errors->has("date_of_registration"))
                    <span class="alert alert-danger">{{$errors->first("date_of_registration")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date2" class="col-md-2 col-form-label">Date Of Renewal <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="date" name="date_of_renewal" placeholder="Enter the vehicle number" class="form-control" value="{{$fleet->date_renewal}}"> 
                @if($errors->has("date_of_renewal"))
                    <span class="alert alert-danger">{{$errors->first("date_of_renewal")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="capacity" class="col-md-2 col-form-label">Seating Capacity <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="seating_capacity" placeholder="Enter the seating capacity" class="form-control" value="{{$fleet->seating}}"> 
                @if($errors->has("seating_capacity"))
                    <span class="alert alert-danger">{{$errors->first("seating_capacity")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Ac / Non Ac <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="ac" id="" class="form-control">
                    <option value="">Select feature</option>
                    <option value="ac"<?php if($fleet->ac=="ac"){echo "selected";} ?>>Ac</option>
                    <option value="nac" <?php if($fleet->ac=="nac"){echo "selected";} ?>>Non Ac</option>
               </select>                
               @if($errors->has("ac"))
                    <span class="alert alert-danger">{{$errors->first("ac")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Feature Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/fleets/'.$fleet->image)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fimage" class="col-md-2 col-form-label">Front Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/fleets/'.$fleet->front_image)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="front_image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("front_image"))
                    <span class="alert alert-danger">{{$errors->first("front_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="rimage" class="col-md-2 col-form-label">Rear Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/fleets/'.$fleet->rear_image)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="rear_image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("rear_image"))
                    <span class="alert alert-danger">{{$errors->first("rear_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="simage" class="col-md-2 col-form-label">Side Image <span class="star">*</span> </label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/fleets/'.$fleet->side_image)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="side_image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("side_image"))
                    <span class="alert alert-danger">{{$errors->first("side_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="simage" class="col-md-2 col-form-label">Features <span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea name="features" id="summernote">{{$fleet->features}}</textarea> 
                @if($errors->has("features"))
                    <span class="alert alert-danger">{{$errors->first("features")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="travel_type" class="col-md-2 col-form-label">Travel Type <span class="star">*</span> </label>
            <div class="col-md-8"> 
               <select name="travel_type" id="" class="form-control">
                   <option value="">Select a travel type</option>
                   <option value="oneway"<?php if($fleet->travel_type=="oneway"){ echo "selected";}?>>oneway</option>
                   <option value="round"<?php if($fleet->travel_type=="round"){ echo "selected";}?>>round</option>
                   <option value="local_80"<?php if($fleet->travel_type=="local_80"){ echo "selected";}?>>local|8hr|80km</option>
                   <option value="local_120"<?php if($fleet->travel_type=="local_120"){ echo "selected";}?>>local|12hr|120km</option>
                   <option value="airport"<?php if($fleet->travel_type=="airport"){ echo "selected";}?>>airport</option>
               </select>
                @if($errors->has("travel_type"))
                    <span class="alert alert-danger">{{$errors->first("travel_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                   <option value="">Select Status</option>
                   <option value="active"<?php if($fleet->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($fleet->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection