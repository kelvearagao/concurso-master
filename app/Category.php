<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /** 
     * Uma categoria pertence a varias questões.
     */

    public function questions()
    {
        return $this->belongsToMany('App\Question', 'questions_categories', 'category_id', 'question_id');
    }

}