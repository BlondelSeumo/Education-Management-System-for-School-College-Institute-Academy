<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmItemIssue extends Model
{
    public function items(){
    	return $this->belongsTo('App\SmItem', 'item_id', 'id');
    }

    public function categories(){
    	return $this->belongsTo('App\SmItemCategory', 'item_category_id', 'id');
    }
    
}
