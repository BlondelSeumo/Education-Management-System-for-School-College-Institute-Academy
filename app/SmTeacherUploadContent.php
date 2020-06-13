<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmTeacherUploadContent extends Model
{
    public function contentTypes(){
		return $this->belongsTo('App\SmContentType', 'content_type', 'id');
	}

	public function roles(){
		return $this->belongsTo('App\Role', 'available_for', 'id');
	}

	public function classes(){
		return $this->belongsTo('App\SmClass', 'class', 'id');
	}
	public function sections(){
		return $this->belongsTo('App\SmSection', 'section', 'id');
	}
}
