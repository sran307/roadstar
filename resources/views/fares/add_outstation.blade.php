@extends("layouts.layout")
@section("title", "addoutstation")
@section("content")
<div class="container">
    <form action="{{route('outstation_models.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add Outstation Fare Management</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}" selected>{{$country->country}}</option>
                    @endforeach
               </select>                
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="type" id="trip_selector" class="form-control">
                   <option value="">Select A Type</option>
                    <option value="oneway">One Way Trip</option>
                    <option value="round">Rounded Trip</option>
               </select>                
               @if($errors->has("type"))
                    <span class="alert alert-danger">{{$errors->first("type")}}</span>
                @endif
            </div>
        </div>

        <div class="row form-group">
            <label for="vehicle_type" class="col-md-2 col-form-label">Vehicle Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="vehicle_type" id="" class="form-control">
                   <option value="">Select Vehicle type</option>
                   @foreach($vehicles as $vehicle)
                    <option value="{{$vehicle->id}}">{{$vehicle->model_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
    
        <div class="row form-group">
            <label for="cover_km" id="base_fare_label" class="col-md-2 col-form-label">Base Fare KM <span class="star">*</span></label>
            <div class="col-md-3">
                <input type="text" name="base_fare_km" id="base_fare_field" placeholder="Enter the km" class="form-control" value="{{old('base_fare_km')}}">
                @if($errors->has("base_fare_km"))
                    <span class="alert alert-danger">{{$errors->first("base_fare_km")}}</span>
                @endif
            </div>
            <label for="basefare" class="col-md-2 col-form-label">Price Of Base KM <span class="star">*</span></label>
            <div class="col-md-3">
                <input type="text" name="base_fare" placeholder="Enter the price" class="form-control" value="{{old('base_fare')}}">
                @if($errors->has("base_fare"))
                    <span class="alert alert-danger">{{$errors->first("base_fare")}}</span>
                @endif
                <span class="star" id="price_over" style="display:none">Enter The price Related To 300KM</span>
            </div>
        </div>
        <div class="row form-group" id="extra_field" style="display:none;">
            <label for="fpkm" class="col-md-2 col-form-label">Extra Price Per KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="price_per_km" placeholder="Enter extra your price per km" class="form-control" value="{{old('price_per_km')}}">
                @if($errors->has("price_per_km"))
                    <span class="alert alert-danger">{{$errors->first("price_per_km")}}</span>
                @endif
            </div>
        </div>
        <!--<div class="row form-group">
            <label for="fpkm" class="col-md-2 col-form-label">Total Coverage KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="total_coverage_km" placeholder="Enter your total coverage km" class="form-control" value="{{old('total_coverage_km')}}">
                @if($errors->has("total_coverage_km"))
                    <span class="alert alert-danger">{{$errors->first("total_coverage_km")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row form-group">
            <label for="allowance" class="col-md-2 col-form-label">Driver Allowance <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="allowance" placeholder="Enter driver allowance" class="form-control" value="{{old('allowance')}}">
                @if($errors->has("allowance"))
                    <span class="alert alert-danger">{{$errors->first("allowance")}}</span>
                @endif
            </div>
        </div>

        <div id="toll_field" style="display:none;" class="row form-group">
            <label for="night halt" id="toll_label" class="col-md-2 col-form-label">Toll Charge  <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="nighthalt" placeholder="Enter toll charge " class="form-control" value="{{old('nighthalt')}}">
                @if($errors->has("nighthalt"))
                    <span class="alert alert-danger">{{$errors->first("nighthalt")}}</span>
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
               <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $("#trip_selector").change(function (e) { 
            e.preventDefault();
            var val = $(this).val();
            if(val=="round"){
                $("#base_fare_label").text("Minimum KM Per Day");
                $("#base_fare_label").append("<span class='star'>*</span>");
                $("#extra_field").show();
                $("#toll_field").show();
                $("#toll_label").text("Toll Charge & Night Halt");
                $("#toll_label").append("<span class='star'>*</span>");
            }else{
                $("#base_fare_label").text("Base Fare KM");
                $("#base_fare_label").append("<span class='star'>*</span>");
                $("#extra_field").hide();
                $("#toll_field").hide();
                $("#toll_label").text("Toll Charge");
                $("#toll_label").append("<span class='star'>*</span>");
            }
        });
    });

    $("#base_fare_field").keyup(function (e) { 
        var type=$("#trip_selector").val();
        if(type=="oneway"){
            var val=$(this).val();
            if(val>100){
                $("#toll_field").show();
                $("#price_over").show();
            }else{
                $("#toll_field").hide();
                $("#price_over").hide();
            }
        }

    });
</script>
<script>
    $(document).ready(function () {
        $("#trip_selector").change(function (e) { 
            e.preventDefault();
            var val=$(this).val();
            $.ajax({
                type: "post",
                data: {val: val, "_token": "{{ csrf_token() }}"},
                url: "{{route('fetch_car_model')}}",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                }
            });
        });
    });
</script>
@endsection
