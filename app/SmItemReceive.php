<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmItemReceive extends Model
{
    public function suppliers(){
    	return $this->belongsTo('App\SmSupplier', 'supplier_id', 'id');
    }

    
}
