@extends("layouts.layout")
@section("title", "dashboard")
@section("content")
<?php
  $customers=App\Models\Customer::count("id");
  $drivers=App\Models\Driver::count("id");
  $total_revenue=App\Models\TripRequest::sum("total");
  $total_booking=App\Models\TripRequest::count("id");
  $complete=App\Models\TripRequest::where("status", "Completed")->count("id");
  $data=["jan"=>10, "feb"=>23];
  
?>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="row">
            <!-- Total Customers Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">{{$customers}} </div>
                    <div>Customers</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Customers Widget Section Started -->

            <!-- Total Booking Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">{{$total_booking}}</div>
                    <div>Total Booking</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Booking Widget Section Ended -->

            <!-- Complete Booking Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">{{$complete}}</div>
                    <div>Complete Booking</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Complete Booking Widget Section Ended -->

            <!-- Total Drivers Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">{{$drivers}} </div>
                    <div>Total Drivers</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Drivers Widget Section Ended -->

            <!-- Active Booking Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">0</div>
                    <div>Active Booking</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Active Booking Widget Section Ended -->

            <!-- Cancelled Booking Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">{{App\Models\Cancellation::count("id")}}</div>
                    <div>Cancelled Booking</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Cancelled Booking Widget Section Started -->

            <!-- Driver Cancelled Booking Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">0</div>
                    <div>Driver Cancelled Booking</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Driver Cancelled Booking Widget Section Ended -->

            <!-- Total Revenue Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">{{$total_revenue}}</div>
                    <div>Total Revenue</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Revenue Widget Section Ended -->

            <!-- Scheduled Booking Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">0</div>
                    <div>Scheduled Booking</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Scheduled boking Widget Section Ended -->

            <!-- Reviews Widget Section Started -->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-secondary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">{{App\Models\ReviewModel::count("id")}}</div>
                    <div>Reviews </div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Scheduled boking Widget Section Ended -->


          </div>
          
        </div>

        <!-- Chart div start -->
        <div class="row sr_chart1">
          <div class="col-md-6">
            <div>
              <canvas id="myChart"></canvas>
            </div>
          </div>
          <div class="col-md-6">
            <div>
              <canvas id="myChart1"></canvas>
            </div>
          </div>
        </div>
        
        <!-- Chart div end -->
      </div>
      <script>
  const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];
  const day=[
    {x: Date.parse("2022-01-01 00:00:00 GMT+0530"), y:18},
    {x: Date.parse("2022-01-02"), y:15},
    {x: Date.parse("2022-01-03"), y:20}

    ]

  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(132, 132, 255)',
      borderColor: 'rgb(255, 99, 132)',
      data: [10, 5, 2, 20, 30, 45],
    }]
  };

  const data1 = {
    //labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(132, 132, 255)',
      borderColor: 'rgb(255, 99, 132)',
      data: day,
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };
  const config1 = {
    type: 'bar',
    data: data1,
    options: {
      scales:{
        x: {
          type: "time",
          time: {
            unit: "day"
          }
        },
        y: {
          beginAtZero: true
        }
      }
    }
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
<script>
  const myChart1 = new Chart(
    document.getElementById('myChart1'),
    config1
  );
</script>
 
 @endsection