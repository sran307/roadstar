<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function fleets()
    {
        return $this->hasMany(DriverVehicle::class, "driver_id");
    }

    public function trips()
    {
        return $this->hasMany(NewTrip::class, "driver_id")->orderBy("id", "desc");
    }

    public function reviews()
    {
        return $this->hasManyThrough(ReviewModel::class, NewTrip::class, "driver_id", "driver_id");
    }
}
