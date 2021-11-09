<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_timeline extends Model
{
    //
     protected $table = "course_timeline";
    

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
