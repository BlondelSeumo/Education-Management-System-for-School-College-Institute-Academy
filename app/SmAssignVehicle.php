<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmAssignVehicle extends Model
{
    public function route(){
    	return $this->belongsTo('App\SmRoute', 'route_id', 'id');
    }
    public function vehicle(){
    	return $this->belongsTo('App\SmVehicle', 'vehicle_id', 'id');
    }
}
