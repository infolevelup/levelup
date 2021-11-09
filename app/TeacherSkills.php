<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherSkills extends Model
{
    //
    public $table='teacher_skills';
     protected $fillable = [
       'user_id','skills'
    ];
}
