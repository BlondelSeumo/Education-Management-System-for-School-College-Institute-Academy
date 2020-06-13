<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmMarksRegisterChild extends Model
{
    public function subject(){
    	return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }
}
