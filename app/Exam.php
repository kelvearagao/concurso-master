<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

	public function questions() {
		return $this->belongsToMany('App\Question', 'exam_questions', 'exam_id', 'question_id');
	}

}