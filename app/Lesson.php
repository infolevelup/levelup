<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
     protected $fillable = ['title', 'slug', 'lesson_image', 'short_text', 'full_text', 'download_text','pdf_text','position', 'downloadable_files', 'free_lesson', 'published', 'course_id'];

}
