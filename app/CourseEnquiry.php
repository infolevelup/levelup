<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseEnquiry extends Model
{
    
    
    protected $fillable = [
        'name','email','phone','date', 'message','course_name','time_to_call_back'
    ];
}
