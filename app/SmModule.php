<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmModule extends Model
{
    public function moduleLink(){
    	return $this->hasMany('App\SmModuleLink', 'module_id', 'id');
    }
}
