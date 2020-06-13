<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmComplaint extends Model
{
    public function complaintType(){
    	return $this->belongsTo('App\SmSetupAdmin', 'complaint_type', 'id');
    }

    public function complaintSource(){
    	return $this->belongsTo('App\SmSetupAdmin', 'complaint_source', 'id');
    }
}
