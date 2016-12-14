<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOptionAnswer extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'question_options_answers';

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
