<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['description', 'type_id'];
	
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
            return $this->belongsToMany('App\Option', 'question_options', 'question_id', 'option_id')->withPivot('value');
        else if( $this->type->code == 'LINK' )
        	return $this->belongsToMany('App\Option', 'link_options', 'question_id', 'option_id')->withPivot('link_id');
   	}

    /**
     * Retorna a resposta
     */

    public function answer()
    {
        return $this->belongsToMany('App\Option', 'question_options_answers', 'question_id', 'option_id');
    }

    /** 
     * Uma questão pertence a várias categorias.
     */

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'questions_categories', 'question_id', 'category_id');
    }

}
