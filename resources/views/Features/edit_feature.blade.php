@extends("layouts.layout")
@section("title", "edit_feature_setting")
@section("content")
<div class="container">
    <div>
        <h6>Edit Feature Settings</h6>
        <div>
            @foreach($features as $feature)
            <form action="{{route('feature_settings.update',[$feature->id])}}" method="post">
                @csrf
                @method("PUT")
                <div class="row form-group">
                    <label for="enable sms" class="col-md-2 col-form-label">Enable SMS <span class="star">*</span> </label>
                    <div class="col-md-8">
                        <select name="enable_sms" id="" class="form-control">
                            <option value="Yes"<?php if($feature['enable_sms']=="Yes") echo "selected";?>>Yes</option>
                            <option value="No" <?php if($feature['enable_sms']=="No") echo "selected";?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="enable mail" class="col-md-2 col-form-label">Enable Mail <span class="star">*</span> </label>
                    <div class="col-md-8">
                        <select name="enable_mail" id="" class="form-control">
                            <option value="Yes"<?php if($feature['enable_mail']=="Yes") echo "selected";?>>Yes</option>
                            <option value="No" <?php if($feature['enable_mail']=="No") echo "selected";?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="enable sms" class="col-md-2 col-form-label">Enable Refferal Module <span class="star">*</span> </label>
                    <div class="col-md-8">
                        <select name="enable_module" id="" class="form-control">
                            <option value="Yes"<?php if($feature['enable_module']=="Yes") echo "selected";?>>Yes</option>
                            <option value="No" <?php if($feature['enable_module']=="No") echo "selected";?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 text-center">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
                @endforeach
            </form>
        </div>
    </div>
</div>

@endsection
