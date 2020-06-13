<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmFeesMaster extends Model
{
    public function feesTypes(){
		return $this->belongsTo('App\SmFeesType', 'fees_type_id');
	}

	public function feesGroups(){
		return $this->belongsTo('App\SmFeesGroup', 'fees_group_id', 'id');
	}


	public function feesTypeIds(){
		return $this->hasMany('App\SmFeesMaster', 'fees_group_id', 'fees_group_id');
	}
	
}
