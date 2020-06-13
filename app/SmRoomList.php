<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmRoomList extends Model
{
    public function dormitory(){
    	return $this->belongsTo('App\SmDormitoryList', 'dormitory_id');
    }

    public function roomType(){
    	return $this->belongsTo('App\SmRoomType', 'room_type_id');
    }
}
