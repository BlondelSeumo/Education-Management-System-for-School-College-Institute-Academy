<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmLeaveDefine extends Model
{
    public function role(){
    	return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    public function leaveType(){
    	return $this->belongsTo('App\SmLeaveType', 'type_id', 'id');
    }
}
