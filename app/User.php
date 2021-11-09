<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'role_id','name', 'email', 'password','lastname','images','gender','description','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function roles()
{
   return $this->belongsTo('App\Role');
}
    public function is_admin(){

        if($this->admin){
            return true;
        }
        return false;

    }
    
       public function comments()
{
    return $this->hasMany(Comment::class);
}

public function tickets()
{
    return $this->hasMany(Ticketing::class);
}
    public function teacherProfile(){
        return $this->hasOne(TeacherProfile::class);
    } 
    
    
    
    
    
    
    
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_student');
    }

    public function chapters()
    {
        return $this->hasMany(ChapterStudent::class,'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user');
    }

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }


    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
