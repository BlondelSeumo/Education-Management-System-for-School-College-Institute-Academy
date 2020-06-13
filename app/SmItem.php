<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmItem extends Model
{
    public function category(){
    	return $this->belongsTo('App\SmItemCategory', 'category_name', 'id');
    }
}
