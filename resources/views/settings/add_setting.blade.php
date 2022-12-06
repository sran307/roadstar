@extends("layouts.layout")
@section("title", "add_settings")
@section("content")
<div class="container">
<form action="{{route('general_settings.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add General Settings</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Site Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="site_name" placeholder="Enter your site name" class="form-control" value="{{old('site_name')}}">
                @if($errors->has("site_name"))
                    <span class="alert alert-danger">{{$errors->first("site_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="meta_title" class="col-md-2 col-form-label">Meta Title <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="meta_title" placeholder="Enter your meta title" class="form-control" value="{{old('meta_title')}}">
                @if($errors->has("meta_title"))
                    <span class="alert alert-danger">{{$errors->first("meta_title")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="meta_keyword" class="col-md-2 col-form-label">Meta Keyword <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="meta_keyword" placeholder="Enter your meta keyword" class="form-control" value="{{old('meta_keyword')}}">
                @if($errors->has("meta_keyword"))
                    <span class="alert alert-danger">{{$errors->first("meta_keyword")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="meta_description" class="col-md-2 col-form-label">Meta Description <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="meta_description" placeholder="Enter your meta description" class="form-control" value="{{old('meta_description')}}">
                @if($errors->has("meta_description"))
                    <span class="alert alert-danger">{{$errors->first("meta_description")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="play_store_url" class="col-md-2 col-form-label">Play Store Url </label>
            <div class="col-md-8">
                <input type="text" name="play_store_url" placeholder="Enter your play store url" class="form-control" value="{{old('play_store_url')}}">
                @if($errors->has("play_store_url"))
                    <span class="alert alert-danger">{{$errors->first("play_store_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="app_store_url" class="col-md-2 col-form-label">App Store Url </label>
            <div class="col-md-8">
                <input type="text" name="app_store_url" placeholder="Enter your app store url" class="form-control" value="{{old('app_store_url')}}">
                @if($errors->has("app_store_url"))
                    <span class="alert alert-danger">{{$errors->first("app_store_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="email" class="col-md-2 col-form-label">Email </label>
            <div class="col-md-8">
                <input type="text" name="email" placeholder="Enter your email id" class="form-control" value="{{old('email')}}">
                @if($errors->has("email"))
                    <span class="alert alert-danger">{{$errors->first("email")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="phone_number" class="col-md-2 col-form-label">Phone Number </label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter your phone number" class="form-control" value="{{old('phone_number')}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="website_url" class="col-md-2 col-form-label">Website Url <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="website_url" placeholder="Enter your website url" class="form-control" value="{{old('website_url')}}">
                @if($errors->has("website_url"))
                    <span class="alert alert-danger">{{$errors->first("website_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="website_logo" class="col-md-2 col-form-label">Website Logo <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="file" name="website_logo" placeholder="upload logo" class="form-control"> 
                <span class="d-block">(Size less than 100kb and max-width:1450px max-height:1100px) </span>
                @if($errors->has("website_logo"))
                    <span class="alert alert-danger">{{$errors->first("website_logo")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="facebook_url" class="col-md-2 col-form-label">Facebook Url </label>
            <div class="col-md-8">
                <input type="text" name="facebook_url" placeholder="Enter your facebook url" class="form-control" value="{{old('facebook_url')}}">
                @if($errors->has("facebook_url"))
                    <span class="alert alert-danger">{{$errors->first("facebook_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="facebook_logo" class="col-md-2 col-form-label">Facebook Logo </label>
            <div class="col-md-8">
                <input type="file" name="facebook_logo" placeholder="upload logo" class="form-control"> 
                @if($errors->has("facebook_logo"))
                    <span class="alert alert-danger">{{$errors->first("facebook_logo")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="twitter_url" class="col-md-2 col-form-label">Twitter Url </label>
            <div class="col-md-8">
                <input type="text" name="twitter_url" placeholder="Enter your twitter url" class="form-control" value="{{old('twitter_url')}}">
                @if($errors->has("twitter_url"))
                    <span class="alert alert-danger">{{$errors->first("twitter_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="twitter_logo" class="col-md-2 col-form-label">Twitter Logo </label>
            <div class="col-md-8">
                <input type="file" name="twitter_logo" placeholder="upload logo" class="form-control"> 
                @if($errors->has("twitter_logo"))
                    <span class="alert alert-danger">{{$errors->first("twitter_logo")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="linkedin_url" class="col-md-2 col-form-label">LinkedIn Url </label>
            <div class="col-md-8">
                <input type="text" name="linkedin_url" placeholder="Enter your linked url" class="form-control" value="{{old('linkedin_url')}}">
                @if($errors->has("linkedin_url"))
                    <span class="alert alert-danger">{{$errors->first("linkedin_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="linkedin_logo" class="col-md-2 col-form-label">LinkedIn Logo </label>
            <div class="col-md-8">
                <input type="file" name="linkedin_logo" placeholder="upload logo" class="form-control"> 
                @if($errors->has("linkedin_image"))
                    <span class="alert alert-danger">{{$errors->first("linkedin_logo")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="insta_url" class="col-md-2 col-form-label">Instagram Url </label>
            <div class="col-md-8">
                <input type="text" name="insta_url" placeholder="Enter your instagram url" class="form-control" value="{{old('insta_url')}}">
                @if($errors->has("insta_url"))
                    <span class="alert alert-danger">{{$errors->first("insta_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="insta_logo" class="col-md-2 col-form-label">Instagram Logo </label>
            <div class="col-md-8">
                <input type="file" name="insta_logo" placeholder="upload logo" class="form-control"> 
                @if($errors->has("insta_logo"))
                    <span class="alert alert-danger">{{$errors->first("insta_logo")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="youtube_url" class="col-md-2 col-form-label">Pinterest Url</label>
            <div class="col-md-8">
                <input type="text" name="youtube_url" placeholder="Enter your youtube url" class="form-control" value="{{old('youtube_url')}}">
                @if($errors->has("youtube_url"))
                    <span class="alert alert-danger">{{$errors->first("youtube_url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="favicon" class="col-md-2 col-form-label">Favicon <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="file" name="favicon" placeholder="upload logo" class="form-control"> 
                @if($errors->has("favicon"))
                    <span class="alert alert-danger">{{$errors->first("favicon")}}</span>
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

@endsection