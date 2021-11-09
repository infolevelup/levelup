<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = ['order_id','payable_price','user_id','status','order_price','coupon_id','coupon_amount'];
    public $timestamps = true;
}
