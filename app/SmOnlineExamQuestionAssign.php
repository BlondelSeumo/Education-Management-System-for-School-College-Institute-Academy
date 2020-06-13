<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmOnlineExamQuestionAssign extends Model
{
    public function questionBank(){
    	return $this->belongsTo('App\SmQuestionBank', 'question_bank_id', 'id');
    }
}
