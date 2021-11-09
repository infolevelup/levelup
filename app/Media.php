<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public $table='media';
  protected $fillable = ['url', 'course_id','type'];
     public $timestamps = false;
    //
}
