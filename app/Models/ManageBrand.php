<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageBrand extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function fleet()
    {
        return $this->hasMany('App\Models\ManageFleet', "brand");
    }
   
    public function models()
    {
        return $this->hasMany(ManageModel::class, "brand");
    }
}
