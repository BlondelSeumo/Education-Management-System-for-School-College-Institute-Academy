<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmClassSection extends Model
{
    public function sectionName(){
    	return $this->belongsTo('App\SmSection', 'section_id', 'id');
    }
}
