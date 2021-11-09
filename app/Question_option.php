<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_option extends Model
{
    //
     protected $fillable = ['option_text', 'correct', 'explanation', 'question_id'];

   

}
