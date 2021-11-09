<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Session;

class Course extends Model
{
    //

     protected $fillable = ['category_id', 'title', 'slug', 'description', 'price', 'course_image','certificate','schedule','benefits' ,'future','teacher_id', 'published', 'free','corporate','featured', 'trending', 'popular', 'meta_title', 'meta_description', 'meta_keywords'];

    
    
     public static function coursecount(){
        
       $cartcount = DB::table('courses') ->where('published', 1)->count();
        return $cartcount;
    }
    public static function teachercount(){
        
       $tecount = DB::table('users')->where('role_id', 2)->count();
        return $tecount;
    }
    
     public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_user')->withPivot('user_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student')->withTimestamps()->withPivot(['rating']);
    }
    
     public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('position');
    }

    public function publishedLessons()
    {
        return $this->hasMany(Lesson::class)->where('published', 1);
    }

 public function courseTimeline()
    {
        return $this->hasMany(Course_timeline::class);
    }
     public function getRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }
    
     public function reviews()
    {
        return  $this->hasMany(Rating::class)->where('status','approve');
    }
}
