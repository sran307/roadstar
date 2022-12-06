<div class="container">
    <div>
        <h6>Customers</h6>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Country Code</th>
                    <th>Currency</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;
                    $customers=App\Models\Customer::all();
                ?>
                @foreach($customers as $customer)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$customer->first_name}}</td>
                    <td>{{$customer->last_name}}</td>
                    <td>{{$customer->phone_number}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->code}}</td>
                    <td>{{$customer->currency}}</td>
                    <td>{{$customer->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

