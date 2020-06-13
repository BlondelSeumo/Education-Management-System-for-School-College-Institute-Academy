<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmVehicle extends Model
{
    public function driver(){
    	return $this->belongsTo("App\SmStaff", "driver_id", "id");
    }

    public static function findVehicle($id){
    	return SmVehicle::find($id);
    }
}
