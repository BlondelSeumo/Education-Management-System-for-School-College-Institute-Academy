<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmAdmissionQuery extends Model
{
    public function className(){
		return $this->belongsTo('App\SmClass', 'class', 'id');
	}

	public function user(){
    	return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function referenceSetup(){
    	return $this->belongsTo('App\SmSetupAdmin', 'reference', 'id');
    }
    public function sourceSetup(){
    	return $this->belongsTo('App\SmSetupAdmin', 'source', 'id');
    }
}
