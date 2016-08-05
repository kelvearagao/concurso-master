<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * Retorna o link da opção.
     */

   	public function link()
   	{
   		return $this->belongsToMany('App\Option', 'link_options', 'option_id', 'link_id')->withPivot('question_id');
   	}
}
