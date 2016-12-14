<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['description'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Retorna o link da opção.
     */

   	public function link()
   	{
   		return $this->belongsToMany('App\Option', 'link_options', 'option_id', 'link_id')->withPivot('question_id');
   	}

    /**
     * Retorna a questão.
     */

    public function question()
    {
      return $this->belongsToMany('App\Question', 'question_options', 'option_id', 'question_id');
    }
}
