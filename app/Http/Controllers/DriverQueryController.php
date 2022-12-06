<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\{
    Driver, country, DriverVehicle, vehicle
};

class DriverQueryController extends Controller
{
    public function driver_queries()
    {
        return view("drivers.query");
    }
}
