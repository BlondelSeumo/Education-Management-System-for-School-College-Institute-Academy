<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmQuestionBank extends Model
{
    public function questionGroup(){
    	return $this->belongsTo('App\SmQuestionGroup', 'q_group_id');
    }
    public function questionLevel(){
    	return $this->belongsTo('App\SmQuestionLevel', 'question_level_id');
    }
    public function class(){
		return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}
	public function section(){
		return $this->belongsTo('App\SmSection', 'section_id', 'id');
	}
	public function questionMu(){
		return $this->hasMany('App\SmQuestionBankMuOption', 'question_bank_id', 'id');
	}
}
