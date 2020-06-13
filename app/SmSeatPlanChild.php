<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmSeatPlanChild extends Model
{
    public function class_room(){
    	return $this->belongsTo('App\SmClassRoom', 'room_id', 'id');
    }

    public static function usedRoomCapacity($room_id){
    	return SmSeatPlanChild::where('room_id', $room_id)->sum('assign_students');
    }
}
