<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmBaseGroup extends Model
{
    public function baseSetups(){
		return $this->hasmany('App\SmBaseSetup', 'base_group_id');
	} 
}
