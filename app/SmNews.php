<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmNews extends Model
{
    public function category()
    {
        return $this->belongsTo('App\SmNewsCategory');
    }
}
