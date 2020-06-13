<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmBookIssue extends Model
{
    public function books(){
    	return $this->belongsTo('App\SmBook', 'book_id', 'id');
    }
}
