@extends("frontend.layout")
@section("title", "order_confirmation")
@section("content")
<div class="container print_area">
    
    <div class="sr_confirm_heading text-center">
      <h5>Your Booking Has Been Successfully Placed!!!</h5>
      <h6>Confirmation Page.</h6>
    </div>
    <div class="table-responsive sr_invoice_table">
      <table class="table table-bordered">
        <tr>
          <th>Pick Up Code:</th>
          <td>{{$booking_id}}</td>
        </tr>
        <tr>
          <th>Date And Time:</th>
          <td>{{$pickup_date}} / {{$pickup_time}}</td>
        </tr>
        @if($type=="round")
        <tr>
          <th>Return Date:</th>
          <td>{{$return_date}}</td>
        </tr>
        @endif
        <tr>
          <th>Type:</th>
          <td>{{$type}}</td>
        </tr>
        <tr>
          <th>Pick Up From:</th>
          <td>{{$from_address}}</td>
          
        </tr>
        <tr <?php if( $type=="local_120" || $type=="local_80"){echo("style='display:none'");} ?>>
          <th>Drop Off:</th>
          <td><?php if($type=="airport_from"){echo $to_address;}?>
              <?php if($type=="airport_to"){echo $airport_city;}?>
              <?php if($type!="airport_from" && $type!="airport_to"){echo $to_address;}?>
          </td>
        </tr>
        <tr>
          <th>Customer Name:</th>
          <td>{{$name}}</td>
        </tr>
        <tr>
          <th>Contact No:</th>
          <td>{{$phone_number}}</td>
        </tr>
        <tr>
          <th>Email:</th>
          <td>{{$email}}</td>
        </tr>
        <tr>
          <th>Vehicle Type:</th>
          <td>{{$vehicle}}</td>
        </tr>
        <tr>
          <th>Vehicle Number:</th>
          <td>{{$vehicle_number}}</td>
        </tr>
        <tr>
          <th>Amount To Pay:</th>
          <td>{{$fare}}</td>
        </tr>
        <tr>
          <th>Total KM:</th>
          <td>{{$distance}}</td>
        </tr>
        <tr>
          <th>Payment Status:</th>
          <td>{{$payment_status}}</td>
        </tr>
        <tr>
          <th>Payment Remark:</th>
          <td>Remark</td>
        </tr>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="table-responsive sr_invoice_contact">
          <table class="table table-bordered">
            <caption>Support Desk</caption>
            <tr>
              <th>Email</th>
              <td>{{$site_email}}</td>
            </tr>
            <tr>
              <th>Contact NO</th>
              <td>{{$site_contact}}</td>
            </tr>
          </table>
        </div>
      </div>
       <div class="col-md-6 text-center">
      {!! QrCode::size(150)->generate("Name:$name, 
                Booking Id:$booking_id, 
                Contact No: $phone_number,
                Vehicle No: $vehicle_number,
                Pickup From: $from_address,
                Amount: $fare ")!!}
      </div>
    </div>
</div>
<div class="sr_invoice_button text-center">
    <button class="btn btn-primary" id="print_button">Print</button>
  </div>

@endsection
