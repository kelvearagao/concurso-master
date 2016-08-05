<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	
    /**
     * Get the question type.
     */

    public function type()
    {
        return $this->hasOne('App\QuestionType', 'id', 'type_id');
    }

    /**
     * Retorna as opções.
     */

    public function options()
   	{
   		if( $this->type->code == 'ONE_ANSWER' )
            return $this->belongsToMany('App\Option', 'boolean_options', 'question_id', 'option_id')->withPivot('value');
        else if( $this->type->code == 'LINK' )
        	return $this->belongsToMany('App\Option', 'link_options', 'question_id', 'option_id')->withPivot('link_id');
   	}

}
