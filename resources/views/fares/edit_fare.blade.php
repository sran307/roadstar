@extends("layouts.layout")
@section("title", "additional_fare")
@section("content")
<div class="container">
    @foreach($fares as $fare)
    <form action="{{route('fare_models.update', [$fare->id])}}" method="post" >
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Additional Fare Kilometers</legend>
        <div class="row form-group">
            <label for="vehicle_type" class="col-md-2 col-form-label">Vehicle Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="vehicle_type" id="" class="form-control">
                   <option value="">Select Vehicle type</option>
                   @foreach($vehicles as $vehicle)
                   <option value="{{$vehicle->id}}" <?php if($vehicle->id==$fare->vehicle_type){echo "selected";} ?> ><?php echo(App\Models\ManageModel::where("id", $vehicle->model)->value("model_name"));?></option>
                    @endforeach
               </select>                
               @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
       
        <div class="row form-group">
            <label for="waiting charge" class="col-md-2 col-form-label">Waiting Charge <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="waiting_charge" placeholder="Enter your waiting charge" class="form-control" value="{{$fare->waiting_charge}}">
                @if($errors->has("waiting_charge"))
                    <span class="alert alert-danger">{{$errors->first("waiting_charge")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="extra" class="col-md-2 col-form-label">Extra Hour Charge <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="extra_hour_charge" placeholder="Enter your extra hour charge" class="form-control" value="{{$fare->extra_hour_charge}}">
                @if($errors->has("extra_hour_charge"))
                    <span class="alert alert-danger">{{$errors->first("extra_hour_charge")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fpkm" class="col-md-2 col-form-label">Fare Per KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="fare_per_km" placeholder="Enter your fare per km" class="form-control" value="{{$fare->fare_per_km}}">
                @if($errors->has("fare_per_km"))
                    <span class="alert alert-danger">{{$errors->first("fare_per_km")}}</span>
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

@endsection
