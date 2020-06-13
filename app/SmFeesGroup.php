<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmFeesGroup extends Model
{
    public function feesMasters(){
		return $this->hasmany('App\SmFeesMaster', 'fees_group_id');
	}
}
