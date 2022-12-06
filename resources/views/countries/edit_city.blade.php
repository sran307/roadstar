@extends("layouts.layout")
@section("title", "Cities")
@section("content")
<div class="container">
    @foreach($cities as $city)
    <form action="{{route('city_trips.update', [$city->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Add Country</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">From City <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Enter trip start city" id="from_city" name="from_city" class="form-control" value="{{$city->from_address}}">             
               @if($errors->has("from_city"))
                    <span class="alert alert-danger">{{$errors->first("from_city")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="currency" class="col-md-2 col-form-label">To City <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Enter trip end city" id="to_city" name="to_city" class="form-control" value="{{$city->to_address}}">             
               @if($errors->has("to_city"))
                    <span class="alert alert-danger">{{$errors->first("to_city")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Distance <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Enter the distance" id="distance" name="distance" class="form-control" value="{{$city->distance}}">             
               @if($errors->has("distance"))
                    <span class="alert alert-danger">{{$errors->first("distance")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Choose The Type <span class="star">*</span></label>
            <div class="col-md-4">
              <input type="radio" name="type" value="normal" <?php if($city->type=="normal"){echo "checked";} ?> > <label for="" class="form-check-label">Normal</label> 
            </div>
            <div class="col-md-4">
              <input type="radio" name="type" value="airport" <?php if($city->type=="airport"){echo "checked";} ?>> <label for="" class="form-check-label">Airport</label> 
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($city->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($city->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
<script>
    $("#distance").mouseenter(function () { 
       var fcity= $("#from_city").val();
       var tcity = $("#to_city").val();

       $.ajax({
           type: "post",
           url: "{{route('city_distance')}}",
           data: {fcity: fcity, tcity:tcity, "_token": "{{ csrf_token() }}"},
           dataType: "json",
           success: function (response) {
               console.log(response);
               $("#distance").val(response.status);
           }
       });
    });
</script>
@endsection
