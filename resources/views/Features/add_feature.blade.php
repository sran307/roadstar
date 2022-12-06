@extends("layouts.layout")
@section("title", "add_feature_setting")
@section("content")
<div class="container">
    <div>
        <h6>Add Feature Settings</h6>
        <div>
            <form action="{{route('feature_settings.store')}}" method="post">
                @csrf
                <div class="row form-group">
                    <label for="enable sms" class="col-md-2 col-form-label">Enable SMS <span class="star">*</span> </label>
                    <div class="col-md-8">
                        <select name="enable_sms" id="" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="enable mail" class="col-md-2 col-form-label">Enable Mail <span class="star">*</span> </label>
                    <div class="col-md-8">
                        <select name="enable_mail" id="" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="enable sms" class="col-md-2 col-form-label">Enable Refferal Module <span class="star">*</span> </label>
                    <div class="col-md-8">
                        <select name="enable_module" id="" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 text-center">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
