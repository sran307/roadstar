@extends("frontend.layout")
@section("title", "order_confirmation")
@section("content")
<div class="container">
    <div class="sr_confirm_heading text-center">
        Pick Up Order Confirmation
    </div>
    <div class="row sr_confirm_row">
        <div class="col-md-6 col-sm-6">
            <div class="row sr_confirm_user">
                <div class="col-md-12 sr_confirm_col1">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Name:</label>
                        <div class="col-md-8">
                            <p>{{$name}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sr_confirm_col2">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Contact No:</label>
                        <div class="col-md-8">
                            <p>{{$phone}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sr_confirm_col3">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Email:</label>
                        <div class="col-md-8">
                            <p>{{$email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="row sr_confirm_info">
                <div class="col-md-12 sr_confirm_col4">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Date:</label>
                        <div class="col-md-8">
                            <p>{{$date}} /  {{date("g:i A", strtotime($time))}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sr_confirm_col5">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Request Code:</label>
                        <div class="col-md-8">
                            <p>{{$booking_id}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 sr_confirm_col6">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Pick Up:</label>
                        <div class="col-md-8">
                            <p><?php if($type=="airport_from"){echo $airport_address;}?>
                            <?php if($type=="airport_to"){echo $pick_address;}?>
                            <?php if($type!="airport_to" && $type!="airport_from"){echo $pick_address;}?></p>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-6 sr_confirm_col6" <?php if( $type=="local_120" || $type=="local_80"){echo("style='display:none'");} ?> >
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Drop:</label>
                        <div class="col-md-8">
                        <p><?php if($type=="airport_from"){echo $drop_address;}?>
                            <?php if($type=="airport_to"){echo $airport_address;}?>
                            <?php if($type!="airport_to" && $type!="airport_from"){echo $drop_address;}?></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 sr_confirm_detail">
            <div class="row">
            <div class="col-md-6 col-sm-6">
            <div class="row sr_confirm_user">
                <div class="col-md-12 sr_confirm_col1">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Vehicle Type:</label>
                        <div class="col-md-8">
                            <p>{{$model}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sr_confirm_col2">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Total KM:</label>
                        <div class="col-md-8">
                            <p>{{$distance}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sr_confirm_col3">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Remarks:</label>
                        <div class="col-md-8">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="row sr_confirm_user">
                <div class="col-md-12 sr_confirm_col1">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Total Amount:</label>
                        <div class="col-md-8">
                            <p>{{$amount}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sr_confirm_col2">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Status:</label>
                        <div class="col-md-8">
                            <p>{{$status}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sr_confirm_col3">
                    <div class="row form-group">
                        <label for="Name" class="col-md-4 col-form-label">Payment Status:</label>
                        <div class="col-md-8">
                            <p>{{$payment_status}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
    <form action="{{route('invoice')}}" method="post">
        @csrf
        <input type="hidden" name="token" value={{$token}}>
        <input type="hidden" name="amount" value={{$amount}}>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Amount To Be Paid <span class="star">*</span></label>
            <div class="col-md-6"> 
                <input type="number" name="amount_paid" id="amount_paid_field" placeholder="Enter the amount you pay now" class="form-control" value={{$amount}} required> 
                @if($errors->has("amount_paid"))
                    <span class="alert alert-danger">{{$errors->first("amount_paid")}}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
       
    </form>
</div>

@endsection
