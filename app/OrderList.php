<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    //
     protected $fillable = ['order_id','course_id','price','user_id','status','type'];
public $timestamps = false;
}
