<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    //
         public $table = "teacher_profiles";
 protected $fillable = [
       'user_id'
    ];
}
