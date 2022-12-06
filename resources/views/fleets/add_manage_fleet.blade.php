@extends("layouts.layout")
@section("title", "add_fleet")
@section("content")
<div class="container">
<form action="{{route('manage_fleets.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Fleet</legend>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Vehicle code<span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="vehicle_code" placeholder="Enter the vehicle code" class="form-control" value="{{old('vehicle_code')}}"> 
                @if($errors->has("vehicle_code"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_code")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="title" class="col-md-2 col-form-label">Title <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="title" placeholder="Enter the title" class="form-control" value="{{old('title')}}"> 
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
                    <option value="{{$category->id}}">{{$category->name}}</option>
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
                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
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
                    <option value="{{$model->id}}">{{$model->model_name}}</option>
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
                <input type="text" name="variant" placeholder="Enter the variant" class="form-control" value="{{old('variant')}}"> 
                @if($errors->has("variant"))
                    <span class="alert alert-danger">{{$errors->first("variant")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="variant" class="col-md-2 col-form-label">Bags <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="bags" placeholder="Enter the number of air bags" class="form-control" value="{{old('bags')}}"> 
                @if($errors->has("bags"))
                    <span class="alert alert-danger">{{$errors->first("bags")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="chase" class="col-md-2 col-form-label">Chase Number <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="chase_number" placeholder="Enter the chase number" class="form-control" value="{{old('chase_number')}}"> 
                @if($errors->has("chase_number"))
                    <span class="alert alert-danger">{{$errors->first("chase_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle" class="col-md-2 col-form-label">Vehicle Number <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="vehicle_number" placeholder="Enter the vehicle number" class="form-control" value="{{old('vehicle_number')}}"> 
                @if($errors->has("vehicle_number"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date1" class="col-md-2 col-form-label">Date Of Registration <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="date" name="date_of_registration" placeholder="Enter the vehicle number" class="form-control" value="{{old('date_of_registration')}}"> 
                @if($errors->has("date_of_registration"))
                    <span class="alert alert-danger">{{$errors->first("date_of_registration")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date2" class="col-md-2 col-form-label">Date Of Renewal <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="date" name="date_of_renewal" placeholder="Enter the vehicle number" class="form-control" value="{{old('date_of_renewal')}}"> 
                @if($errors->has("date_of_renewal"))
                    <span class="alert alert-danger">{{$errors->first("date_of_renewal")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="capacity" class="col-md-2 col-form-label">Seating Capacity <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="seating_capacity" placeholder="Enter the seating capacity" class="form-control" value="{{old('seating_capacity')}}"> 
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
                    <option value="ac">Ac</option>
                    <option value="nac">Non Ac</option>
               </select>                
               @if($errors->has("ac"))
                    <span class="alert alert-danger">{{$errors->first("ac")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Feature Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fimage" class="col-md-2 col-form-label">Front Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="front_image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("front_image"))
                    <span class="alert alert-danger">{{$errors->first("front_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="rimage" class="col-md-2 col-form-label">Rear Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="rear_image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("rear_image"))
                    <span class="alert alert-danger">{{$errors->first("rear_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="simage" class="col-md-2 col-form-label">Side Image <span class="star">*</span> </label>
            <div class="col-md-8"> 
                <input type="file" name="side_image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("side_image"))
                    <span class="alert alert-danger">{{$errors->first("side_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="simage" class="col-md-2 col-form-label">Features <span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea name="features" id="summernote">{{old('features')}}</textarea> 
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
                   <option value="oneway">oneway</option>
                   <option value="round">round</option>
                   <option value="local_80">local|8hr|80km</option>
                   <option value="local_120">local|12hr|120km</option>
                   <option value="airport">airport</option>
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
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
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