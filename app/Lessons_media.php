<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lessons_media extends Model
{
    //
     protected $fillable = ['name', 'lesson_id', 'filename', 'url', 'type'];
     public $timestamps = false;
}
