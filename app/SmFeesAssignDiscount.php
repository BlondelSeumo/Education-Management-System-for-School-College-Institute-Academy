<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmFeesAssignDiscount extends Model
{
    public function feesDiscount(){
    	return $this->belongsTo('App\SmFeesDiscount', 'fees_discount_id', 'id');
    }
}
