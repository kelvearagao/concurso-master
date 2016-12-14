<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['question_id', 'option_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
