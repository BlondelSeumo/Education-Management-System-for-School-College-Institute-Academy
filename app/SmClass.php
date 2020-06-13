<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmClass extends Model
{


    // public function sections(){
    // 	return $this->belongsTo('App\SmSection', 'id', 'section_id');
    // }
    public function classSection(){
    	return $this->hasMany('App\SmClassSection', 'class_id');
    }
    public function sectionName(){
    	return $this->belongsTo('App\SmSection', 'section_id');
    }
    public function sections()
	{
	return $this->hasMany('App\SmSection', 'id', 'section_id');
	}
}
