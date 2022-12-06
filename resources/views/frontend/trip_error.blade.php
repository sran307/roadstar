@extends("frontend.layout")
@section("title", "Error")
@section("content")

<div class="viewcabcabz sr_error">
	<div class="container sr_bg">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="pickadalone sr_error_msg">
                    <h6>Trip is not available!!! </h6>
                    <p>Try another one.</p>
                    <div class="tab-content">
                        <div class="tab-pane active" id="one-way"> 
                        <form method="POST" action="{{route('home')}}" class="trip-frm2 sr_oneway_form">
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="search-btn">Book Once More <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>	
                            </div>
                        </form> 
                    </div>
                </div>	
            </div>
        </div>
	</div>
</div>





@endsection
