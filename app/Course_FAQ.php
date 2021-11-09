<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_FAQ extends Model
{
   protected $fillable=['course_id','question','answer'];
}
