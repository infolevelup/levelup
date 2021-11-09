<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table = 'ratings';
    protected $primaryKey = 'id';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['course_id','user_id','session_id','rating','comments']; 
    
 public function user(){
        return $this->belongsTo(User::class);
    }
}
