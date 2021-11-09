<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
        protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['qustion','answer'];
     
}