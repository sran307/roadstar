<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function customer_trips()
    {
       return $this->hasMany(TripRequest::class, "customer")->orderBy("id", "desc");
    }

    public function assigned()
    {
        return $this->hasMany(NewTrip::class, "customer_id")->orderBy("id", "desc");
    }
}
