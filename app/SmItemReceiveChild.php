<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmItemReceiveChild extends Model
{
    public function items(){
    	return $this->belongsTo('App\SmItem', 'item_id', 'id');
    }
}
