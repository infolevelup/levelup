<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lessons_video_media extends Model
{
        protected $table = 'lessons_video_media';

    protected $fillable = ['video_link', 'video_title', 'video_short_desc', 'lesson_id', 'type'];
public $timestamps = false;

}
