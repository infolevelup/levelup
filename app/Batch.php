<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
   protected $fillable=['batch_name','batch_date','batch_timings','batch_days','course_id','teacher_id'];
}
