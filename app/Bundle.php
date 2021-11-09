<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    //
    
    protected $fillable = ['category_id', 'title', 'slug', 'description', 'price', 'course_image', 'start_date', 'published','free', 'featured', 'trending', 'popular', 'meta_title', 'meta_description', 'meta_keywords','user_id'];

}
