<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmNewsCategory extends Model
{
    public function news()
    {
        return $this->hasMany('App\SmNews');
    }
}
