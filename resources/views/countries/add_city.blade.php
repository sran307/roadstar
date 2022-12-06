@extends("layouts.layout")
@section("title", "City Trips")
@section("content")
<div class="container">
<form action="{{route('city_trips.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add City Trip</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">From City <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Enter trip start city" id="from_city" name="from_city" class="form-control" value="{{old('from_city')}}">             
               @if($errors->has("from_city"))
                    <span class="alert alert-danger">{{$errors->first("from_city")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="currency" class="col-md-2 col-form-label">To City <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Enter trip end city" id="to_city" name="to_city" class="form-control" value="{{old('to_city')}}">             
               @if($errors->has("to_city"))
                    <span class="alert alert-danger">{{$errors->first("to_city")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Distance <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Enter the distance" id="distance" name="distance" class="form-control" value="{{old('distance')}}">             
               @if($errors->has("distance"))
                    <span class="alert alert-danger">{{$errors->first("distance")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Choose The Type <span class="star">*</span></label>
            <div class="col-md-4">
              <input type="radio" name="type" value="normal" checked> <label for="" class="form-check-label">Normal</label> 
            </div>
            <div class="col-md-4">
              <input type="radio" name="type" value="airport"> <label for="" class="form-check-label">Airport</label> 
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
               <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
    </form>
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
