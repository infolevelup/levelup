<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_student extends Model
{
    protected $fillable=['course_id','user_id'];
    
}
