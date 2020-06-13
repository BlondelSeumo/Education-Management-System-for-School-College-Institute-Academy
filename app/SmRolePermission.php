<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmRolePermission extends Model
{
    public function moduleLink(){
    	return $this->belongsTo('App\SmModuleLink', 'module_link_id', 'id');
    } 
}
